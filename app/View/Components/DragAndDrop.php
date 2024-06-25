<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DragAndDrop extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $options;
    public $dragndrop;
    public function __construct(
        $id,
        $dragndrop = null
    )
    {
        $this->id = $id;
        $this->options = [
            '1', '2', '3', '4',
        ];
        $this->dragndrop = $dragndrop;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.drag-and-drop');
    }
}
