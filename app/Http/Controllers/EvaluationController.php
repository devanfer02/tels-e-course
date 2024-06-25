<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\SubCourse;
use App\Models\Course;
use App\Http\Services\EvaluationService;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    private $evaluationService;

    public function __construct()
    {
        $this->evaluationService = new EvaluationService();
    }

    public function getEvaluation(SubCourse $subcourse)
    {
        return $this->evaluationService->getEvalBySubcourse($subcourse);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Course $course)
    {
        try {
            return $this->evaluationService->makeEvaluation($request, $course);
        } catch(\Exception $e) {
            return redirect()->back()->with('failed', 'failed to create evaluation');
        }
    }

    public function make()
    {
        $pageTitle = 'Buat Ujian';

        return view('pages.evaluations.make', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $this->evaluationService->createEvaluation($request);

            return redirect('mata-pelajaran')->with('success', 'Berhasil membuat ujian');

        } catch(\Exception $e) {
            return redirect('mata-pelajaran')->with('failed', 'Gagal membuat ujian');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        $evaluation = $evaluation->load(
            'questions.options.pilgandas',
            'questions.options.dragNDrops',
            'questions.questionCategory',
            'subcourse',
            'evaluationCategory'
        );

        $pageTitle = 'Ujian Materi ' . $evaluation->subcourse->subcourse_name;

        return view('pages.evaluations.detail', compact('evaluation', 'pageTitle'));
    }

    public function showUser(Evaluation $evaluation)
    {
        $evaluation = $evaluation->load(
            'questions.options.pilgandas',
            'questions.options.dragNDrops',
            'questions.questionCategory',
            'subcourse',
            'evaluationCategory'
        );

        $index = 1;

        return view('pages.client.quiz.index', compact('evaluation', 'index'));
    }

    public function viewResult(SubCourse $subcourse)
    {
        $subcourse->load('course');

        return view('pages.client.quiz.result', compact('subcourse'));
    }

    public function submit(SubCourse $subcourse)
    {
        return redirect()->route('quiz.result', $subcourse->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        $evaluation = $evaluation->load(
            'questions.options.pilgandas',
            'questions.options.dragNDrops',
            'questions.questionCategory',
            'subcourse',
            'evaluationCategory'
        );

        $pageTitle = 'Ujian Materi ' . $evaluation->subcourse->subcourse_name;

        return view('pages.evaluations.edit', compact('evaluation', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        try {
            $this->evaluationService->updateEvaluation($request, $evaluation);

            return redirect(route('show-ujian', $evaluation->id))->with('success', 'Successfully update ujian materi ' . $evaluation->subcourse->subcourse_name);
        } catch (\Exception $e) {
            return redirect(route('show-ujian', $evaluation->id))->with('failed', 'Failed to update ujian');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        try {

            $courseId = $this->evaluationService->deleteEvaluation($evaluation);

            return redirect(route('show-mapel', $courseId))->with('success', 'Berhasil menghapus ujian');


        } catch(\Exception $e) {
            return redirect(route('mata-pelajaran'))->with('failed', 'Gagal menghapus ujian');
        }
    }
}

