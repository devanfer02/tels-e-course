<?php

namespace App\Livewire;

use App\Http\Services\EvaluationService;
use App\Http\Services\SubcourseService;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluationList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $kategori;
    public $judulMateri;
    public $judulMapel;
    private $evalService;

    public function __construct()
    {
        $this->evalService = new EvaluationService();
    }

    public function render()
    {
        $evaluations = $this->evalService->getEvaluations([
            'kategori' => $this->kategori,
            'judul_materi' => $this->judulMateri,
            'judul_mapel' => $this->judulMapel
        ]);

        return view('livewire.evaluation-list', compact('evaluations'));
    }

    public function updated()
    {
        $this->render();
    }
}
