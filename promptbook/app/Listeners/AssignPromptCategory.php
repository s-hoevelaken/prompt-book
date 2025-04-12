<?php

/*
    Contributor: Xander
*/
namespace App\Listeners;

use App\Models\Categories;
use App\Events\PromptCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class AssignPromptCategory implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue on which to place the job.
     *
     * @var string|null
     */
    public $queue = 'assign-prompt-category';
    public $retryAfter = 60;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PromptCreated $event): void
    {
        $prompt = $event->prompt;
        $categories = Categories::all();

        $matchedCategoryIds = [];

        foreach ($categories as $category) {
            // Check if the category name is present in the prompt title or description
            if (
                stripos($prompt->title, $category->name) !== false ||
                stripos($prompt->description, $category->name) !== false
            ) {
                $matchedCategoryIds[] = $category->id;
            }
        }

        // attach all matched categories to the prompt
        if (!empty($matchedCategoryIds)) {
            $prompt->categories()->sync($matchedCategoryIds);
        }
    }
}
