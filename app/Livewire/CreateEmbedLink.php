<?php

namespace App\Livewire;

use App\Http\Services\FileStorage;
use Livewire\Component;

class CreateEmbedLink extends Component
{
    public $ytLink;
    public $embedLink;
    private $fileStorage;

    public function __construct()
    {
        $this->fileStorage = new FileStorage();
    }

    public function render()
    {
        return view('livewire.create-embed-link');
    }

    public function updatedYTLink()
    {
        $this->embedLink = $this->fileStorage->ytWatchToEmbed($this->ytLink);
    }
}
