<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Services\AdminRecordService;
use Livewire\WithPagination;

class RecordList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $namaAdmin = '';
    public $action = '';
    public $date = '';

    public function render()
    {
        $records = AdminRecordService::getRecords([
            'nama_admin' => $this->namaAdmin,
            'aksi' => $this->action,
            'tanggal' => $this->date
        ]);

        return view('livewire.record-list', compact('records'));
    }

    public function updated()
    {
        $this->render();
    }

    public function clearDate()
    {
        $this->date = '';
    }
}
