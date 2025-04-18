<?php

/*
    Contributor: Stephan
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompt;
use App\Models\Like;
use App\Events\PromptCreated;
use App\Models\Favorite;
use App\Http\Requests\StorePromptRequest;
use App\Http\Requests\EditPromptRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PromptController extends Controller
{
    public function searchByTitle(Request $request)
    {
        $query = strtolower($request->input('query'));
        $keywords = explode(' ', $query);
        
        // putting the query in a loop to that we can check for each word seperatetly 
        // and using DB::raw so that we can use the SQL lower function
        $prompts = DB::table('prompts')
            ->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere(DB::raw('LOWER(title)'), 'LIKE', "%{$word}%")
                      ->orWhere(DB::raw('LOWER(description)'), 'LIKE', "%{$word}%");
                }
            })
            ->where(function ($q) {
                $q->where('is_public', 1)
                  ->orWhere('user_id', Auth::id());
            })
            ->get();

        if ($prompts->isEmpty()) {
            return response()->json([
                'prompts' => [],
                'message' => 'No prompts found'
            ]);
        }
    
        return response()->json(['prompts' => $prompts]);
    }
    



    public function toggleLike($id)
    {
        $user = Auth::id();

        $like = Like::where('prompt_id', $id)->where('user_id', $user)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Prompt unliked successfully.']);
        } else {
            Like::create([
                'prompt_id' => $id,
                'user_id' => $user,
            ]);
            return response()->json(['message' => 'Prompt liked successfully.']);
        }
    }

    public function toggleFavorite($id)
    {
        $user = Auth::id();

        $favorite = Favorite::where('prompt_id', $id)->where('user_id', $user)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Prompt removed from favorites.']);
        } else {
            Favorite::create([
                'prompt_id' => $id,
                'user_id' => $user,
            ]);
            return response()->json(['message' => 'Prompt added to favorites.']);
        }
    }


    public function store(StorePromptRequest $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }

        $validatedData = $request->validated();
        $filePath = null;

        if ($request->hasFile('content')) {
            $uploadedFile = $request->file('content');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $uploadedFile->storeAs('prompts', $fileName, 'local');
            $filePath = 'prompts/' . $fileName;
        }

        $prompt = Prompt::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'content' => $filePath,
            'output_format' => $validatedData['output_format'],
            'is_public' => $validatedData['is_public']
        ]);

        event(new PromptCreated($prompt));

        return redirect()->route('homepage');
    }

    public function myPrompts()
    {
        $prompts = Prompt::with(['user', 'likes', 'favorites'])
                     ->where('user_id', Auth::id())
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);

        $prompts->getCollection()->transform(function ($prompt) {
            $prompt->liked = $prompt->likes->contains('user_id', Auth::id());
            $prompt->favorited = $prompt->favorites->contains('user_id', Auth::id());
            unset($prompt->likes);
            unset($prompt->favorites);
            return $prompt;
        });

        return response()->json($prompts);
    }

    public function allPrompts()
    {
        $prompts = Prompt::with(['user', 'likes', 'favorites'])
                     ->where('is_public', 1)
                     ->where('user_id', '!=', Auth::id())
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);

        $prompts->getCollection()->transform(function ($prompt) {
            $prompt->liked = $prompt->likes->contains('user_id', Auth::id());
            $prompt->favorited = $prompt->favorites->contains('user_id', Auth::id());
            unset($prompt->likes);
            unset($prompt->favorites);
            return $prompt;
        });

        return response()->json($prompts);
    }


    public function allFavoritedPrompts()
    {
        $prompts = Prompt::with(['user', 'likes', 'favorites'])
                    ->whereHas('favorites', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        $prompts->getCollection()->transform(function ($prompt) {
            $prompt->liked = $prompt->likes->contains('user_id', Auth::id());
            return $prompt;
        });

        return response()->json($prompts);
    }


    public function togglePublicity($id)
    {
        $prompt = Prompt::where('id', $id)->where('user_id', Auth::id())->first();


        if (!$prompt) {
            return response()->json(['error' => 'Prompt not found.'], 404);
        }

        if (Auth::id() !== $prompt->user_id) {
            abort(403, 'You do not have permission to modify this prompt.');
        }
    
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
    
    public function destroy($id)
    {
        $prompt = Prompt::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$prompt || !Auth::check()) {
            return response()->json(['error' => 'Prompt not found or access denied.'], 403);
        }

        $prompt->delete();

        return response()->json(['message' => 'Prompt deleted successfully.'], 200);
    }

    

    public function update(EditPromptRequest $request, $id)
    {
        $prompt = Prompt::where('id', $id)->where('user_id', $request->user()->id)->first();

        if (!$prompt) {
            return response()->json(['error' => 'Prompt not found or access denied.'], 404);
        }

        $validatedData = $request->validated();

        $prompt->title = $validatedData['title'];
        $prompt->description = $validatedData['description'];
        $prompt->content = $validatedData['content'];
        $prompt->save();

        return response()->json(['message' => 'Prompt updated successfully.']);
    }
}
