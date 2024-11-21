<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use App\Http\Controllers\PromptController;
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
        $prompts = Prompt::where('user_id', $this->user_id)->get()->transform(function ($prompt) {
            $prompt->description = strip_tags($prompt->description);
            $prompt->content = strip_tags($prompt->content);
            return $prompt;
        });

        $promptController = new PromptController();
        $favPromptsResponse = $promptController->allFavoritedPrompts();

        $favPromptsData = $favPromptsResponse->getData(assoc: true);

        $favPrompts = $favPromptsData['data'];
        return view('livewire.pages.viewpage', [
            'prompts' => $prompts,
            'favPrompts' => $favPrompts
        ])->layout('layouts.app');
    }
}