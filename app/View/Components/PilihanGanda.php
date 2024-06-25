<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PilihanGanda extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $options;
    public $pilgan;
    public $correct;
    public function __construct(
        $id,
        $pilgan=null
    )
    {
        $this->id = $id;
        $this->options = [
            'A', 'B', 'C', 'D'
        ];
        $this->pilgan = $pilgan;
        if(isset($pilgan)) {
            foreach($this->pilgan as $index => $pilgan) {
                if($pilgan->pilgandas->correct) {
                    $this->correct = $this->options[$index];
                    break;
                }
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pilihan-ganda');
    }
}
