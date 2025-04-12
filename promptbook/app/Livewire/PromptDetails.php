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

    protected function getLocalImagesForCategories($categories)
    {
        $google_key = env('MY_GOOGLE_API_KEY');
        $search_key = env('GOOGLE_SEARCH_KEY');
        $data = [];

        if ($categories) {
            foreach($categories as $category) {
                $images = "https://www.googleapis.com/customsearch/v1?key={$google_key}&cx=$search_key&q={$category}&searchType=image";

                $respone = Http::get($images);
                $data = json_decode($respone->body(), true);
            }

            return $data['items'][0]['link'];
        }
    }
}