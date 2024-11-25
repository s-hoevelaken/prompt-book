<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Like;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Prompt;

class Feedpage extends Component
{
    use WithPagination;

    public $search = '';
    public $pagination = 12;
    public $filter = '';
    public $newComment = ''; 

    public $flashMessage = null;
    public $isMessageVisible = true;
    public $expandedDescriptions = [];

    // Listen to the 'refreshComments' event and trigger $refresh
    protected $listeners = ['refreshComments' => '$refresh', 'flashmessage' => 'dismissFlashMessage'];

    public function dismissFlashMessage()
    {
        $this->isMessageVisible = false; // Hide the message when clicked
    }

    /*
        Add a comment to a prompt
    */
    public function addComment($promptId)
    {
        Log::info("Adding comment to prompt: " . $promptId);

        $this->validate([
            'newComment' => 'required|max:100',
        ]);

        $prompt = Prompt::find($promptId);

        if (!$prompt) {
            session()->flash('error', 'Prompt not found.');
            return;
        }

        Comment::create([
            'user_id' => Auth::id(),
            'prompt_id' => $prompt->id,
            'content' => $this->newComment,
        ]);

        Log::info("Comment created");

        $this->newComment = '';

        $this->flashMessage = 'Comment added.';
        $this->isMessageVisible = true;
        $this->dispatch('refreshComments'); 

        session()->flash('message', 'Comment added.');
    }

    /*
        Filter prompts by likes, favorites or search
    */
    public function filterBy($type)
    {
        $this->filter = $type;
    }

    public function clearFilters()
    {
        $this->filter = '';
    }

    /*
        Increase content length
    */
    public function toggleDescription($id)
    {
        if (isset($this->expandedDescriptions[$id])) {
            unset($this->expandedDescriptions[$id]);
        } else {
            $this->expandedDescriptions[$id] = true;
        }
    }

    /*
        Like or Favorite a prompt
    */
    public function toggleLike($promptId)
    {
        $like = Like::where('user_id', Auth::id())
            ->where('prompt_id', $promptId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create(['user_id' => Auth::id(), 'prompt_id' => $promptId]);
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
            Favorite::create(['user_id' => Auth::id(), 'prompt_id' => $promptId]);
        }
    }

    #[Title('Prompts feed page')]
    public function render()
    {
        $query = Prompt::query()
            ->with(['user', 'comments.user'])
            ->where('title', 'like', '%' . $this->search . '%');

        if ($this->filter === 'likes') {
            $query->whereHas('likes', function ($query) {
                $query->where('user_id', Auth::id());
            });
        } elseif ($this->filter === 'favorites') {
            $query->whereHas('favorites', function ($query) {
                $query->where('user_id', Auth::id());
            });
        }

        Log::info("Filter applied: " . $this->filter);

        $prompts = $query->orderBy('created_at', 'desc')->paginate($this->pagination);

        return view('livewire.pages.feedpage', [
            'users' => $prompts,
        ])->layout('layouts.app');
    }
}

