<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

class Creationpage extends Component
{
    #[Title('Create a Prompt')]
    public function render()
    {
        return view('livewire.pages.create')->layout('layouts.app');
    }
}
