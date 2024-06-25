<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PilihanGandaView extends Component
{
    public $pilganda;
    public $id;
    public $show;
    /**
     * Create a new component instance.
     */
    public function __construct($pilganda, $id, $show = true)
    {
        $this->pilganda = $pilganda;
        $this->id = $id;
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pilihan-ganda-view');
    }
}
