<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class CourseCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $course;
    public $route;
    public function __construct($course, $route)
    {
        $this->course = $course;

        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-card');
    }
}
