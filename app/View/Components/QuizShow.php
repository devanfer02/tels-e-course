<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuizShow extends Component
{
    /**
     * Create a new component instance.
     */
    public $questions;
    public $evaluation;
    public $index;

    public function __construct($evaluation, $questions, $index)
    {
        $this->evaluation = $evaluation;
        $this->questions = $questions;
        $this->index = $index;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.quiz-show');
    }
}
