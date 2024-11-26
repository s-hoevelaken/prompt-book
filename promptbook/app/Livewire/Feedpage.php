<?php

/*
    Contributor: Xander
*/

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;

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

    protected $listeners = ['refreshComments' => '$refresh', 'flashmessage' => 'dismissFlashMessage'];


    /*
        Dismiss the flash message
    */
    public function dismissFlashMessage()
    {
        $this->isMessageVisible = false;
    }


    /*
        Add a comment to a prompt
    */
    public function addComment($promptId)
    {
        $this->validate([
            'newComment' => 'required|max:100|min:1',
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

        $this->newComment = '';
        $this->flashMessage = 'Comment added.';
        $this->isMessageVisible = true;
        
        // refresh comments
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


    /*
        Like or Favorite a comment
    */
    public function toggleCommentLike($commentId)
    {
        $comment = Comment::find($commentId);
        $like = $comment->likes()->where('user_id', Auth::id())->first();

        if (!$comment) {
            session()->flash('error', 'Comment not found.');
            return;
        }

        if ($like) {
            $like->delete();
        } else {
            $comment->likes()->create(['user_id' => Auth::id()]);
        }

        $this->dispatch('refreshComments');
    }

    public function toggleCommentFavourite($commentId)
    {
        $comment = Comment::find($commentId);
        $favourite = $comment->favorites()->where('user_id', Auth::id())->first();

        if (!$comment) {
            session()->flash('error', 'Comment not found.');
            return;
        }

        if ($favourite) {
            $favourite->delete();
        } else {
            $comment->favorites()->create(['user_id' => Auth::id()]);
        }

        $this->dispatch('refreshComments');
    }


    /* 
        Page rendering
    */
    #[Title('Prompts feed page')]
    public function render()
    {
        $prompts = Prompt::query()
            ->with(['user', 'comments.user'])
            ->where('title', 'like', '%' . $this->search . '%')
            ->applyFilter($this->filter) 
            ->orderBy('created_at', 'desc')
            ->paginate($this->pagination);

        return view('livewire.pages.feedpage', [
            'users' => $prompts,
        ])->layout('layouts.app');
    }
}

