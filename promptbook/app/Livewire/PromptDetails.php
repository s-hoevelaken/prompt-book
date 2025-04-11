<?php

namespace App\Livewire;

use App\Http\Resources\PromptResource;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Prompt;

class PromptDetails extends Component
{
    public $prompt;
    
    public function title()
    {
        return "Prompt Details: {$this->prompt->title}";
    }

    public function mount($prompt)
    {
        $this->prompt = Prompt::findOrFail($prompt); 
    }

    public function render()
    {
        return view('livewire.pages.prompt-details', [
            'prompt' => new PromptResource($this->prompt),
        ])->layout('layouts.app', ['title' => $this->prompt->title]);
    }
}