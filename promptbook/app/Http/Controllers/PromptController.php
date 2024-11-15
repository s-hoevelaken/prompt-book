<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompt;
use App\Http\Requests\StorePromptRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PromptController extends Controller
{
    public function store(StorePromptRequest $request)
    {
        $validatedData = $request->validated();

        $prompt = Prompt::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'content' => $validatedData['content'],
            'is_public' => $validatedData['is_public']
        ]);

        return redirect()->route('homepage');
    }

    public function myPrompts()
    {
        $prompts = Prompt::where('user_id', Auth::id())
                         ->orderBy('created_at', 'desc')
                         ->with('user')
                         ->paginate(10);

        return response()->json($prompts);
    }

    public function allPrompts()
    {
        $prompts = Prompt::where('is_public', 1)
                         ->where('user_id', '!=', Auth::id())
                         ->orderBy('created_at', 'desc')
                         ->with('user')
                         ->paginate(10);

        return response()->json($prompts);
    }
}
