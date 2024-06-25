<?php

namespace App\Livewire;

use Livewire\Component;

class QuestionInput extends Component
{
    public $id;
    public $type;
    public $deskripsiSoal;
    public $question;

    public function mount($id, $type= "Pilihan Ganda", $question = null)
    {
        $this->type = $type;
        $this->$id = intval($id);
        $this->deskripsiSoal = "";
        $this->question = $question;
    }
    public function render()
    {
        return view('livewire.question-input');
    }

    public function updated()
    {
        $this->render();
    }
}
