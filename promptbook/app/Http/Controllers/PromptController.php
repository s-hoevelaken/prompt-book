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

        return redirect()->route('dashboard');
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

    public function togglePublicity($id)
    {
        $prompt = Prompt::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$prompt) {
            return response()->json(['error' => 'Prompt not found or access denied.'], 404);
        }

        $prompt->is_public = !$prompt->is_public;
        $prompt->save();

        return response()->json([
            'message' => 'Prompt publicity status updated successfully.',
            'is_public' => $prompt->is_public
        ]);
    }
}
