<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use App\Models\Prompt;

class Feedpage extends Component
{
    // find user id
    public $user_id;

    public function mount()
    {
        $this->user_id = Auth::id();
    }


    #[Title('View your Prompts')]
    public function render()
    {
        // get all the prompts made by users
        $allprompts = Prompt::all();

        return view('livewire.pages.feedpage', [
            'allprompts' => $allprompts
        ])->layout('layouts.app');
    }
}
