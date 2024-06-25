<?php

namespace App\Livewire;

use App\Http\Services\CourseService;
use Livewire\Component;
use Livewire\WithPagination;

class CourseList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = "";
    public $grade = "";
    public $curriculum = "";
    public $major = "";
    private $courseService;
    public $route;
    public $userId;
    public $displayButton;

    public function __construct()
    {
        $this->courseService = new CourseService;
    }

    public function mount($route, $displayButton = false, $userId = '')
    {
        $this->route = $route;
        $this->userId = $userId;
        $this->displayButton = $displayButton;
    }

    public function render()
    {
        $courses = $this->courseService->getAllCourses(12, [
            'mapel' => $this->search,
            'kelas' => $this->grade,
            'kurikulum' => $this->curriculum,
            'jurusan' => $this->major,
            'user_id' => $this->userId
        ]);

        return view('livewire.course-list', compact('courses'));
    }

    public function updated()
    {
        $this->render();
    }
}
