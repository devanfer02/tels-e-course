<?php

namespace App\Livewire;

use App\Http\Services\CourseService;
use App\Http\Services\SubcourseService;
use Livewire\Component;

class MakeEvaluation extends Component
{
    public $mapel;
    public $mapelId;
    private $courseService;
    private $subcourseService;

    public function __construct()
    {
        $this->courseService = new CourseService();
        $this->subcourseService = new SubcourseService();
        $this->mapel = '';
        $this->mapelId = '';
    }

    public function render()
    {
        $courses = $this->courseService->getAllCourses()->toArray();
        $subcourses = [];
        if (!empty($this->mapel)) {
            $this->mapelId = $this->courseService->getCourseByName($this->mapel)->id;
            $subcourses = $this->subcourseService->getSubcourses($this->mapel)->toArray();
        }
        return view('livewire.make-evaluation', compact('courses', 'subcourses'));
    }

    public function updated()
    {
        $this->render();
    }
}
