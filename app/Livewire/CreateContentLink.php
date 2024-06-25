<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Services\FileStorage;

class CreateContentLink extends Component
{
    public $shareLink;
    public $contentLink;
    private $fileStorage;

    public function __construct()
    {
        $this->fileStorage = new FileStorage();
    }

    public function render()
    {
        return view('livewire.create-content-link');
    }

    public function updatedShareLink()
    {
        $this->updatedContentLink();
    }

    public function updatedContentLink()
    {
        $this->contentLink = $this->fileStorage->gdriveShareToContent($this->shareLink);
    }
}
