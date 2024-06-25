<?php

namespace App\Http\Services;

use App\Models\Evaluation;
use App\Models\Question;
use App\Models\Option;
use App\Models\DragNDrop;
use App\Models\PilihanGanda;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use App\Helpers\Logger;
use Ramsey\Uuid\Uuid;
use Amp;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    private $pilgandaService;
    private $dragNdropService;
    private $optionService;

    public function __construct()
    {
        $this->pilgandaService = new PilihanGandaService();
        $this->dragNdropService = new DragAndDropService();
        $this->optionService = new OptionService();
    }

    public function createQuestion(Request $request, $id, $evalId)
    {
        try {
            $category = QuestionCategory::where('category_name', '=', $request['kategori' . $id])->first();

            if(!$category) {
                // category doesnt exist
                return ;
            }

            $questionId = Uuid::uuid7();

            $data = [
                'id' => $questionId,
                'category_id' => $category->id,
                'evaluation_id' => $evalId,
                'description' => $request['deskripsi' . $id]
            ];

            Question::create($data);

            if ($category->category_name === "Pilihan Ganda") {
                $options = ['A', 'B', 'C', 'D'];
                $tasks = [];

                foreach($options as $option) {
                    $tasks[$option] = Amp\async(function() use($request, $questionId, $option, $id) {
                        $this->pilgandaService->createPilgan($request, $questionId, $option, $id);
                    });
                }

                foreach($options as $option) {
                    $tasks[$option]->await();
                }
            } else if ($category->category_name === 'Drag and Drop'){
                $keys = ['1', '2', '3', '4'];
                $tasks = [];

                foreach($keys as $key) {
                    $tasks[$key] = Amp\async(function() use($request, $questionId, $key, $id) {
                        $this->dragNdropService->createDragNDrop($request, $questionId, $key, $id);
                    });
                }

                foreach($keys as $key) {
                    $tasks[$key]->await();
                }
            }
        } catch(\Exception $e) {
            Logger::errLog('[QUESTION SERVICE]', $e->getMessage());
            throw $e;
        }
    }

    public function updateQuestion(Request $request, Question $question)
    {
        /*
        TODO:
            - TESTING UPDATE QUESTION SAME CATEGORY
            - TESTING UPDATE QUESTION DIFF CATEGORY
        */
        DB::beginTransaction();

        try {

            $question->fill([
                'description' => $request['deskripsi' . $request['id']]
            ])->save();

            $question = $question->load([
                'evaluation',
                'questionCategory',
                'options.pilgandas',
                'options.dragNDrops'
            ]);

            if($question->questionCategory->category_name === ( $request['kategori' . $request['id']] )) {
                // KATEGORINYA MASIH SAMA
                $tasks = [];

                if($question->questionCategory->category_name === "Pilihan Ganda") {
                    $letters = ['A', 'B', 'C', 'D'];

                    foreach($question->options as $idx => $option) {

                        $tasks[$idx] = Amp\async(function() use($request, $option, $letters, $idx){
                            $this->pilgandaService->updatePilgan($request, $option, $letters[$idx]);
                        });
                    }
                } else {

                    foreach($question->options as $idx => $option) {

                        $tasks[$idx] = Amp\async(function() use($request, $option, $idx){
                            $this->dragNdropService->updateDragNDrop($request, $option, $idx + 1);
                        });
                    }
                }

                foreach(range(1, 3) as $idx) {

                    $tasks[$idx]->await();
                }

                DB::commit();

                return;
            }

            $taskQuestion = Amp\async(function() use($question, $request) {
                $category = QuestionCategory::where('category_name', '=', $request['kategori' . $request['id']])->first();

                $question->fill([
                    'category_id' => $category->id
                ])->save();
            });


            // KATEGORI BEDA
            $optionTasks = [];
            $tasks = [];

            foreach($question->options as $idx => $option) {
                $optionTasks[$idx] = Amp\async(function() use($option){
                    $this->optionService->deleteOption($option);
                });
            }

            if($request['kategori' . $request['id']] === "Pilihan Ganda") {

                $options = ['A', 'B', 'C', 'D'];

                foreach($options as $option) {
                    $tasks[$option] = Amp\async(function() use($request, $question, $option) {
                        $this->pilgandaService->createPilgan($request, $question->id, $option, $request['id']);
                    });
                }

                foreach($options as $option) {
                    $tasks[$option]->await();
                }
            } else {
                $keys = ['1', '2', '3', '4'];

                foreach($keys as $key) {
                    $tasks[$key] = Amp\async(function() use($request, $question, $key) {
                        $this->dragNdropService->createDragNDrop($request, $question->id, $key, $request['id']);
                    });
                }

                foreach($keys as $key) {
                    $tasks[$key]->await();
                }
            }

            foreach(range(1, 3) as $idx) {
                $optionTasks[$idx]->await();
            }
            
            $taskQuestion->await();

            DB::commit();

        } catch(\Exception $e) {
            Logger::errLog('[QUESTION SERVICE]', $e->getMessage());
            DB::rollBack();
            throw $e;
        }
    }
}
