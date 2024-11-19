<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

class TestController extends Component
{
    public function render()
    {
        return view('livewire.testing-prompt-retrieval')->layout('layouts.app');
    }
}