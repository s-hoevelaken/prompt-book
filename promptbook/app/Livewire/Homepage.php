<?php

/*
    Contributor: Xander
*/

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

class Homepage extends Component
{
    #[Title('Prompt Discovery')]
    public function render()
    {
        return view('livewire.homepage')->layout('layouts.app');
    }
}