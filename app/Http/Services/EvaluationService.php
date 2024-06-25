<?php

namespace App\Http\Services;

use App\Models\Evaluation;
use App\Models\SubCourse;
use App\Helpers\Logger;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Amp;
use App\Models\Course;
use App\Models\EvaluationCategory;
use Illuminate\Support\Facades\DB;

class EvaluationService
{
    private $questionService;

    public function __construct()
    {
        $this->questionService = new QuestionService();
    }

    public function getEvalBySubcourse(SubCourse $subcourse)
    {
        $subcourseWo = clone $subcourse;
        $subcourse = $subcourse->load(
            'evaluation.questions.options',
            'evaluation.questions.options.dragNDrops',
            'evaluation.questions.options.pilgandas',
            'evaluation.questions.questionCategory',
        );

        // Randomize question orders
        $shuffled = $subcourse->evaluation->questions->shuffle();
        $subcourse->evaluation->setRelation('questions', $shuffled);

        // Randomize pilganda's option order
        foreach($subcourse->evaluation->questions as $question) {
            if ($question->questionCategory->category_name === "Pilihan Ganda") {
                $shuffled = $question->options->shuffle();
                $question->setRelation('options', $shuffled);
            } else {

            }
        }

        /*
        TODO :
            - randomize dragndrop's option_value order
        */

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'successfully fetch ujian materi ' . $subcourse->course_name,
            'data' => [
                'materi' => $subcourseWo,
                'ujian' => $subcourse->evaluation
            ]
        ], Response::HTTP_OK);
    }

    public function getEvaluations(array $filters = [])
    {
        $evaluations = Evaluation::with(
            'subcourse',
            'evaluationCategory',
            'subcourse.course'
        )->filter($filters)->latest()->paginate(10);

        return $evaluations;
    }

    public function makeEvaluation(Request $request, Course $course)
    {
        try {
            $subcourse = Amp\async(function() use($request, $course) {
                return SubCourse::where(
                    'subcourse_name', '=', $request['materi'],
                )->where('course_id', '=', $request['course_id'])->first();
            });

            $evalCategory = Amp\async(function() use($request) {
                return EvaluationCategory::where('category_name','=', $request['ujian'])->first();
            });

            $subcourse =  $subcourse->await();
            $evalCategory = $evalCategory->await();

            if (!isset($subcourse->subcourse_name)) {
                return redirect(route('mata-pelajaran'))->with('failed', 'Materi mata pelajaran not found');
            }

            if ($request['ujian'] === 'Kategori') {
                return redirect(route('mata-pelajaran'))->with('failed', 'Kategori ujian not found');
            }

            if (Evaluation::where('subcourse_id', '=', $subcourse->id)->exists()) {
                $evaluation = Evaluation::where('subcourse_id', '=', $subcourse->id)->first();

                return redirect(route('show-ujian', $evaluation->id))->with('success', 'Ujian sudah pernah dibuat');
            }

            $pageTitle = 'Buat Ujian Materi ' . $subcourse->subcourse_name;
            $jumlahSoal = config('constants.jumlahSoal')[$request['ujian']];
            $kkm = intval($request['kkm']);

            return view('pages.evaluations.create', compact(
                'jumlahSoal',
                'evalCategory',
                'subcourse',
                'pageTitle',
                'kkm'
            ));
        } catch(\Exception $e) {
            error_log("[EVALUATION ERR] " . $e->getMessage());
            throw $e;
        }
    }

    public function createEvaluation(Request $request)
    {

        DB::beginTransaction();

        try {
            // TASK 1
            $evalId = Uuid::uuid7();

            Amp\async(function() use($request, $evalId) {
                $evalData = [
                    'id' => $evalId,
                    'subcourse_id' => $request['materi'],
                    'category_id' => $request['kategori'],
                    'minimum_competency' => intval($request['kkm'])
                ];
                return Evaluation::create($evalData);
            });

            $subcourse = Amp\async(function() use($request) {
                return SubCourse::where('id', '=', $request['materi'])->first();
            });

            // TASK 2
            $jumlahSoal = intval($request['jumlahSoal']);
            $question = [];
            foreach(range(1, $jumlahSoal) as $id) {
                $question[$id] = Amp\async(function() use($request, $id, $evalId) {
                    $this->questionService->createQuestion($request, $id, $evalId);
                });
            }

            foreach(range(1, $jumlahSoal) as $id) {
                $question[$id]->await();
            }

            $subcourse = $subcourse->await();

            AdminRecordService::recordLog('created ujian materi ' . $subcourse->subcourse_name);

            DB::commit();

        } catch(\Exception $e) {
            Logger::errLog('[EVALUATION SERVICE]', $e->getMessage());
            DB::rollback();

            throw $e;
        }
    }

    public function updateEvaluation(Request $request, Evaluation $evaluation)
    {
        try {
            $evaluation = $evaluation->load('subcourse');

            AdminRecordService::recordLog('updated ujian materi ' . $evaluation->subcourse->subcourse_name);

            $evaluation->fill($request->all())->save();
        } catch(\Exception $e) {
            Logger::errLog('[EVALUATION SERVICE]', $e->getMessage());

            throw $e;
        }
    }

    public function deleteEvaluation(Evaluation $evaluation)
    {
        try {
            $evaluation = $evaluation->load('subcourse.course');

            $subcourseName = $evaluation->subcourse->subcourse_name;
            $courseId = $evaluation->subcourse->course->id;

            $evaluation->delete();

            AdminRecordService::recordLog('deleted ujian materi ' . $subcourseName);

            return $courseId;
        } catch(\Exception $e) {
            Logger::errLog('[EVALUATION SERVICE]', $e->getMessage());
            throw $e;
        }
    }
}
