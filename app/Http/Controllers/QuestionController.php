<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Services\QuestionService;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $questionService;

    public function __construct()
    {
        $this->questionService = new QuestionService();
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    public function showUser(Evaluation $evaluation, int $index)
    {
        $evaluation = $evaluation->load(
            'questions.options.pilgandas',
            'questions.options.dragNDrops',
            'questions.questionCategory',
            'subcourse',
            'evaluationCategory'
        );

        return view('pages.client.quiz.index', compact('evaluation', 'index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {

        try {
            $this->questionService->updateQuestion($request, $question);

            return redirect(route('edit-ujian', $question->evaluation->id))->with('success', 'Successfully update pertanyaan');
        } catch(\Exception $e) {
            return redirect(route('edit-ujian', $question->evaluation->id))->with('failed', 'Failed to update pertanyaan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
