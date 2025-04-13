<?php

/*
    Contributor: Xander
*/

namespace App\Livewire;

use App\Models\Prompt;
use App\Models\Favorite;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Categories;
use Livewire\Component;
use Livewire\Attributes\Title;

class Homepage extends Component
{
    public $categories;
    public $search = '';

    public $trendingprompts;
    public $recentprompts;

    public $userFavorites = [];

    public function updateSearch()
    {
        Log::info($this->search);
        return redirect()->route('search.results', ['query' => $this->search]);
    }
    
    public function loadprompts()
    {
        $this->trendingprompts = Prompt::where('is_public', 1)
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        $this->recentprompts = Prompt::where('is_public', 1)->latest()->take(5)->get();
    }

    public function mount()
    {
        if (Auth::check()) {
            $this->userFavorites = Favorite::where('user_id', Auth::id())
                ->with('prompt')
                ->latest()
                ->take(5)
                ->get();
        }

        $this->loadprompts();
        $this->categories = Categories::where('image_url', 'not like', '%placeholder.com%')->take(12)->get();
    }

    #[Title('Prompt Discovery')]
    public function render()
    {
        return view('livewire.homepage', [
            'categories' => $this->categories,
        ])->layout('layouts.app');
    }

    // 'prompts' => \App\Models\Prompt::where('is_public', 1)->latest()->take(5)->get(),
    // 'trendingPrompts' => \App\Models\Prompt::where('is_public', 1)->orderBy('likes_count', 'desc')->take(5)->get(),
    // 'recentPrompts' => \App\Models\Prompt::where('is_public', 1)->latest()->take(5)->get(),
    // 'popularPrompts' => \App\Models\Prompt::where('is_public', 1)->orderBy('views_count', 'desc')->take(5)->get(),
    // 'likedPrompts' => \App\Models\Prompt::where('is_public', 1)->orderBy('likes_count', 'desc')->take(5)->get(),
    // 'favoritePrompts' => \App\Models\Prompt::where('is_public', 1)->orderBy('favorites_count', 'desc')->take(5)->get(),
    // 'userPrompts' => \App\Models\Prompt::where('user_id', auth()->id())->latest()->take(5)->get(),
    // 'userFavorites' => \App\Models\Favorite::where('user_id', auth()->id())->latest()->take(5)->get(),
    // 'userLikes' => \App\Models\Like::where('user_id', auth()->id())->latest()->take(5)->get(),
}