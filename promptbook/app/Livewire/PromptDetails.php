<?php

namespace App\Livewire;

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
    }


    public function render()
    {
        return view('livewire.pages.prompt-details', [
            'prompt' => new PromptResource($this->prompt),
        ])->layout('layouts.app', ['title' => $this->prompt->title]);
    }

    protected function getLocalImagesForCategories($categories)
    {
        $images = [];

        foreach ($categories as $category) {
            $imagePath = public_path("images/categories/{$category}.jpg");
            if (file_exists($imagePath)) {
                $images[$category] = asset("images/categories/{$category}.jpg");
            }
        }

        return $images;
    }
}