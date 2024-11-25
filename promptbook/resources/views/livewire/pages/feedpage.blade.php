@props(['users'])

<main class="h-5/6 w-full mx-auto ">
    {{-- header section --}}
    <section class="sm:w-[85%] sm:h-16 mt-20 mx-auto">
        <div class="flex flex-col my-8 justify-center text-white items-center h-full w-full gap-6">
            <h1 class="font-bold text-2xl max-w-[50%] text-center">A list of the best online prompts to make your ai even better then it already is</h1>
            <div class="w-[40%]">
                <form action="" class="flex items-center gap-4 w-full">
                    <input 
                        class="border-[1.5px] border-indigo-700 rounded-md bg-gray-800 bg-opacity-40 w-full focus:ring-0 focus:outline-none focus:border-indigo-400 focus:border-[1.5px] transition-all duration-300 ease-in-out" 
                        type="search" 
                        name="search-prompt" 
                        id="search-prompt" 
                        placeholder="search for a prompt . . ."
                        wire:model.live="search"
                    >
                    <div class="flex items-center gap-3 ml-2">
                        <button type="button" wire:click="filterBy('likes')" class="py-2 px-3 rounded-3xl {{ $filter === 'likes' ? 'bg-indigo-500 text-white' : 'text-gray-500' }}">Likes</button>
                        <button type="button" wire:click="filterBy('favorites')" class="py-2 px-3 rounded-3xl {{ $filter === 'favorites' ? 'bg-indigo-500 text-white' : 'text-gray-500' }}">Favorites</button>
                        <button type="button"wire:click="clearFilters"class="py-2 px-3 rounded-3xl bg-red-500 text-white">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    {{-- prompts section --}}
    <section class="rounded-3xl w-full h-auto shadow-lg grid grid-cols-1 grid-rows-1 place-content-center place-items-center sm:max-w-[85%] mx-auto text-white mt-24">
        @if ($users->isEmpty())
            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                <h1 class="text-3xl font-bold">No prompts found</h1>
                <p class="text-[0.8rem]">Create a new prompt to get started</p>
            </div>
        @else
            <div class="w-full grid sm:grid-cols-4 grid-cols-2 place-content-center place-items-center gap-8 items-start mx-auto">
                @foreach ($users as $user)
                    <div class="w-full prompt-card-bg p-3 rounded-md h-auto overflow-y-scroll max-h-52 shadow-md shadow-purple-700 hover:scale-[1.025] transition-all duration-300 ease-in-out">
                        <div class="flex flex-col items-start justify-start leading-5 mb-3">
                            <h1 class="font-bold text-[1rem]">{{ $user->title }}</h1>
                            <p class="text-indigo-400 text-[0.8rem]">{{ $user->is_public == 1 ? 'public' : 'private' }}</p>
                        </div>
                        
                        <p class="font-thin text-[0.8rem]">
                            @if (isset($expandedDescriptions[$user->id]))
                                {{ $user->description }}
                                <button wire:click="toggleDescription({{ $user->id }})" class="text-indigo-400 ml-2">Show less</button>
                            @else
                                {{ Str::limit($user->description, 50) }}

                                @if (strlen($user->description) > 50)
                                    <button wire:click="toggleDescription({{ $user->id }})" class="text-indigo-400 ml-2">Read more</button>
                                @endif
                                
                                @component('components.promptbook.LikesAndFavorites', ['user' => $user])
                                @endcomponent
                            @endif
                        </p>
                        
                        <p class="font-thin text-[0.75rem] mt-1 text-[#a48ece]">{{ date_format($user->created_at, 'M d, Y') }}</p>
                        @component('components.promptbook.CommentSection', ['user' => $user])
                        @endcomponent    
                              
                    </div>
                    @endforeach
                </div>
                
                @component('components.promptbook.Pagination', ['users' => $users])
                @endcomponent
        @endif
    </section>

    {{-- comment flash message --}}
    @if ($flashMessage && $isMessageVisible)
        <div class="text-green-500 text-sm absolute right-2 bottom-4 transform -translate-x-1/2 bg-white p-3 shadow-md rounded-md z-10" wire:click="dismissFlashMessage">
            {{ $flashMessage }}
        </div>
    @endif
</main>
