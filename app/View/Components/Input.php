<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $placeHolder;
    public $id;
    public $name;
    public $type;
    public $value;
    public $required;
    public $autoComplete;
    public $note;
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $placeHolder,
        string $id,
        string $type = "text",
        string $value = "",
        string $note = null,
        bool $required = false,
        bool $autoComplete = false
    )
    {
        $this->name = $name;
        $this->placeHolder = $placeHolder;
        $this->type = $type;
        $this->id = $id;
        $this->value = $value;
        $this->required = $required;
        $this->autoComplete = $autoComplete;
        $this->note = $note;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
