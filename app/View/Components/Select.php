<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $placeHolder;
    public $id;
    public $name;
    public $type;
    public $value;
    public $required;
    public $autoComplete;
    public $options;
    public $wire;
    public $default;
    public $key;
    public $keyValue;
    public $loadTiny;
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $id,
        string $name = "",
        array $options = [],
        string $placeHolder = "",
        string $value = "",
        string $wire = "",
        bool $required = false,
        bool $autoComplete = false,
        string $default = "",
        string $key = "",
        string $keyValue = "",
        bool $loadTiny = false
    )
    {
        $this->name = $name;
        $this->placeHolder = $placeHolder;
        $this->id = $id;
        $this->value = $value;
        $this->required = $required;
        $this->autoComplete = $autoComplete;
        $this->options = $options;
        $this->wire = $wire;
        $this->default = $default;
        $this->key = $key;
        $this->keyValue = $keyValue;
        $this->loadTiny = $loadTiny;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
