<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DragAndDropView extends Component
{
    public $dragndrop;
    public $id;
    public $show;
    /**
     * Create a new component instance.
     */
    public function __construct($dragndrop, $id, $show = true)
    {
        $this->dragndrop = $dragndrop;
        $this->id = $id;
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.drag-and-drop-view');
    }
}
