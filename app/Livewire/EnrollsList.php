<?php

namespace App\Livewire;

use App\Http\Services\EnrollService;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $userFullname;
    public $mapelName;
    public $date;
    private $enrollService;

    public function __construct()
    {
        $this->enrollService = new EnrollService();
    }

    public function render()
    {
        $enrolls = $this->enrollService->getEnrolls([
            'nama_mapel' => $this->mapelName,
            'nama_pengguna' => $this->userFullname,
            'tanggal' => $this->date
        ]);
        return view('livewire.enrolls-list', compact('enrolls'));
    }

    public function updated()
    {
        $this->render();
    }
}
