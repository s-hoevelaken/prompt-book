<?php

/*
    Contributor: Xander
*/
namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\PromptResource;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Prompt;

class PromptDetails extends Component
{
    public $prompt;
    public $images = [];
    
    public function title()
    {
        return "Prompt Details: {$this->prompt->title}";
    }


    public function mount($prompt)
    {
        $this->prompt = Prompt::findOrFail($prompt); 
    
        $categories = $this->prompt->categories()->pluck('name')->toArray();

        $this->images = $this->getLocalImagesForCategories($categories);
        Log::info($this->images);
    }


    public function render()
    {
        return view('livewire.pages.prompt-details', [
            'prompt' => new PromptResource($this->prompt),
        ])->layout('layouts.app', ['title' => $this->prompt->title]);
    }
}