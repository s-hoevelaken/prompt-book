<?php

/*
    Contributor: Xander
*/

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use App\Models\Prompt;

class Viewpage extends Component
{
    use WithPagination;

    public $search = '';
    public $pagination = 12;
    public $state = 'upload-date';
    public $user_id;

    public $flashMessage = null;
    public $isMessageVisible = true;
    public $expandedDescriptions = [];

    protected $listeners = ['flashmessage' => 'dismissFlashMessage'];

    public function mount()
    {
        $this->user_id = Auth::id();
    }

    public function dismissFlashMessage()
    {
        $this->isMessageVisible = false;
    }


    public function toggleDescription($id)
    {
        if (isset($this->expandedDescriptions[$id])) {
            unset($this->expandedDescriptions[$id]);
        } else {
            $this->expandedDescriptions[$id] = true;
        }
    }

    
    #[Title('View your Prompts')]
    public function render()
    {
        $query = Prompt::where('user_id', $this->user_id)
        ->where('title', 'like', '%' . $this->search . '%');
        
        switch ($this->state) {
            case 'old-date':
                $query->orderBy('created_at', 'asc');
                break;
                case 'total-likes':
                $query->orderBy('likes', 'desc');
                break;
            default:
            $query->orderBy('created_at', 'desc');
            break;
        }
        
        $prompts = $query->paginate($this->pagination)
        ->through(function ($prompt) {
            $prompt->description = strip_tags($prompt->description);
                $prompt->content = strip_tags($prompt->content);
                return $prompt;
            });

        return view('livewire.pages.viewpage', [
            'prompts' => $prompts
        ])->layout('layouts.app');
    }


    #[Title('Update your Prompt')]
    public function edit($promptId)
    {
        $prompt = Prompt::find($promptId);


        // return the updatepage view with the app layout when it isnt a render method
        return view('livewire.pages.updatepage', [
            'prompt' => $prompt
        ])->layout('layouts.app');
    }


    public function deletePrompt($promptId)
    {
        $prompt = Prompt::find($promptId);

        if (!$prompt) {
            session()->flash('error', 'Prompt not found.');
            return;
        }

        if ($prompt->user_id !== Auth::id()) {
            session()->flash('error', 'You do not have permission to delete this prompt.');
            return;
        }

        $this->isMessageVisible = true;

        $prompt->delete();
        session()->flash('success', 'Prompt deleted successfully.');	
    }
}


