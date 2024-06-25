<?php

namespace App\Livewire;

use Livewire\Component;

class CreateEvaluation extends Component
{
    public $active;
    public $jumlahSoal;
    public function mount($jumlahSoal)
    {
        $this->jumlahSoal = intval($jumlahSoal);
        $this->active = 1;
    }
    public function render()
    {
        return view('livewire.create-evaluation');
    }
    public function changeDefault($active)
    {
        $this->active = $active;
        $this->render();
        $this->dispatch('refreshChild');
    }
}
