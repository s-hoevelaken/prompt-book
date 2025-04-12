<?php

/*
    Contributor: Xander
*/
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CodeSnippet extends Component
{
    public $prompt;
    /**
     * Create a new component instance.
     */
    public function __construct($prompt)
    {
        $this->prompt = $prompt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.promptbook.code-snippet');
    }
}
