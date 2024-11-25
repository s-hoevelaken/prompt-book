<?php

namespace App\Livewire;

use App\Models\Favorite;
use Livewire\Component;
use Livewire\Attributes\Title;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Like;
use App\Models\Prompt;
use App\Models\Favourite;

class Feedpage extends Component
{
    public $search = '';
    public $pagination = 20;

    public $expandedDescriptions = [];

    public function toggleDescription($id)
    {
        if (isset($this->expandedDescriptions[$id])) {
            unset($this->expandedDescriptions[$id]);
        } else {
            $this->expandedDescriptions[$id] = true;
        }
    }

    public function toggleLike($promptId)
    {
        $like = Like::where('user_id', Auth::id())
            ->where('prompt_id', $promptId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'prompt_id' => $promptId,
            ]);
        }
    }

    public function toggleFavourite($promptId)
    {
        $favourite = Favorite::where('user_id', Auth::id())
            ->where('prompt_id', $promptId)
            ->first();

        if ($favourite) {
            $favourite->delete();
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'prompt_id' => $promptId,
            ]);
        }
    }


    #[Title('Prompts feed page')]
    public function render()
    {
        $users = Prompt::where('title', 'like', '%' . $this->search . '%')
            ->with('user') // Include related user data if needed
            ->orderBy('created_at', 'desc')
            ->paginate($this->pagination);

        return view('livewire.pages.feedpage', [
            'users' => $users
        ])->layout('layouts.app');
    }

}
