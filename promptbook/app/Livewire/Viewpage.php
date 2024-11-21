<?php

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
    public $state = 'upload-date'; // Add a property for the selected filter
    public $user_id;

    public function mount()
    {
        $this->user_id = Auth::id();
    }

    #[Title('View your Prompts')]
    public function render()
    {
        $query = Prompt::where('user_id', $this->user_id)
            ->where('title', 'like', '%' . $this->search . '%');

        // Apply the filter based on the selected state
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
}