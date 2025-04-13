<?php

namespace App\Livewire;

use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;

class SearchResults extends Component
{
    public $query;
    public $results;

    public function mount($query = '')
    {
        $this->query = $query;
        $this->results = Prompt::where('title', 'like', '%' . $this->query . '%')
            ->orWhere('description', 'like', '%' . $this->query . '%')
            ->withCount('likes')
            ->get();
    }
    

    #[Title('Prompt Search Page')]
    public function render(Request $request)
    {
        $this->query = $request->input('query');

        Log::info($this->query);
        $this->results = Prompt::where('title', 'like', '%' . $this->query . '%')
            ->orWhere('description', 'like', '%' . $this->query . '%')
            ->withCount('likes')
            ->get();

        if ($this->results->isEmpty()) {
            return view('livewire.pages.search-results', [
                'prompts' => $this->results,
                'message' => 'No results found for your search.',
            ])->layout('layouts.app');
        }

        return view('livewire.pages.search-results', [
            'prompts' => $this->results,
        ])->layout('layouts.app');
    }
}
