<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use App\Models\Prompt;

class Viewpage extends Component
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
        // get the prompts of the user
        $prompts = Prompt::where('user_id', $this->user_id)->get();

        return view('livewire.pages.viewpage', [
            'prompts' => $prompts
        ])->layout('layouts.app');
    }
}
