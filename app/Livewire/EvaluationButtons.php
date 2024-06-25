<?php

namespace App\Livewire;

use Livewire\Component;

class EvaluationButtons extends Component
{
    public $active;
    public $jumlahSoal;

    public function mount($jumlahSoal)
    {
        $this->active = 1;
        $this->jumlahSoal = intval($jumlahSoal);
    }
    public function render()
    {
        return view('livewire.evaluation-buttons');
    }

    public function changeActive($active)
    {
        $this->active = $active;
        $this->render();
    }
}
