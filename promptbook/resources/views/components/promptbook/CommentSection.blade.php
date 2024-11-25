@props(['user'])

{{-- add comment --}}
<form wire:submit.prevent="addComment({{ $user->id }})" class="w-full my-2 flex justify-center">
    <input
        wire:model="newComment"
        class=" bg-transparent border-b-[1.5px] border-b-black border-r-0 border-l-0 border-t-0 text-[0.85rem] focus:ring-0 focus:outline-none focus:border-b-gray-200 w-full h-11 placeholder:text-black" 
        type="text" 
        placeholder="Comment Toevoegen">
</form>


{{-- Comment section --}}
@if ($user->comments->isEmpty())
    <p class="text-sm text-gray-300 my-4 text-center">No comments yet.</p>
@else
    <div class="h-full overflow-y-auto mt-6">
        <h1 class="text-[0.85rem] text-black font-extrabold">Comments:</h1>
        @foreach ($user->comments as $comment)
            <div class="mb-2">
                <p class="text-sm font-semibold text-indigo-400">{{ $comment->user->name }}</p>
                <p class="text-gray-300 text-xs">{{ $comment->content }}</p>
                <p class="text-[0.7rem] text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        @endforeach
    </div>
@endif

