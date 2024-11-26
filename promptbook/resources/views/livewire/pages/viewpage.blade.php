@props(['prompts'])

<main class="h-5/6 w-full mx-auto ">
    {{-- header section --}}
    <section class="sm:w-[85%] sm:h-16 my-6 mx-auto">
        <div class="flex flex-row justify-between px-7 gap-4 text-white items-center h-full w-full">
            <div class="flex flex-row gap-5 h-fit items-center justify-between sm:w-2/6 w-3/6">
                <h1 class="font-bold text-3xl w-[90%]">Your Prompts</h1>

                <div class="border-r-[1.5px] border-white w-2 h-12"></div>

                <button class="flex flex-row items-center justify-center gap-1 p-2 bg-green-600 rounded-md w-3/4 ml-3 h-12">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg font-extrabold" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                    </svg>
                    <a class="text-center text-md leading-[2.25rem]" href="{{ route('prompts.create')}}">New prompt</a>
                </button>
            </div>

            <div class="w-2/4 ml-auto grid grid-cols-5 items-center gap-3">
                {{-- search prompt --}}
                <form action="" class="col-span-3">
                    <input 
                        class="border-[1.5px] border-indigo-700 rounded-md bg-gray-800 bg-opacity-40 w-full" 
                        type="search" 
                        name="search-prompt" 
                        id="search-prompt" 
                        placeholder="search for prompt"
                        wire:model.live="search"
                    >
                </form>

                <div class="col-span-2 w-full flex flex-row items-center justify-center">
                    <h2 class="text-indigo-400 w-2/4 text-center">Sort By</h2>
                    <button class="py-2 px-3 rounded-3xl text-black w-2/4 mr-auto flex flex-row items-center justify-center gap-2">
                        <select wire:model.live="state" class="rounded-2xl border-gray-300 bg-gray-100 border-[2.5px] focus:border-gray-400 focus:ring-0 focus:outline-none h-full">
                            <option value="upload-date">Upload date</option>
                            <option value="old-date">Oldest date</option>
                            <option value="total-likes">Total likes</option>
                        </select>
                    </button>
                </div>
            </div>
        </div>
    </section>
    
    {{-- prompts section --}}
    <section class="rounded-3xl w-full h-auto shadow-lg grid grid-cols-1 grid-rows-1 place-content-center place-items-center sm:max-w-[85%] mx-auto text-white mt-12">
        @if ($prompts->isEmpty())
            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                <h1 class="text-3xl font-bold">No prompts found</h1>
                <p class="text-[0.8rem]">Create a new prompt to get started</p>
            </div>
        @else
            <div class="w-full grid sm:grid-cols-4  grid-cols-2 place-content-center place-items-center gap-8 items-start">
                @foreach ($prompts as $prompt)
                    <div class="w-full prompt-card-bg p-3 rounded-md h-auto overflow-y-scroll max-h-44 shadow-md shadow-purple-700 hover:scale-[1.025] transition-all duration-300 ease-in-out">
                        <div class="flex flex-col items-start justify-start leading-5 mb-3">
                            <div class="w-full flex flex-row items-center justify-between">
                                <h1 class="font-bold text-[1rem]">{{ $prompt->title}}</h1>
                                <div class="flex flex-row items-center">
                                    {{-- update button --}}
                                    <a href="{{ route('prompts.edit', $prompt->id) }}" class="flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                        </svg>
                                    </a>                                    

                                    {{-- delete button --}}
                                    <button wire:click="deletePrompt({{ $prompt->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash3 ml-1" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @if ($prompt->is_public == 1)
                                <p class="text-indigo-400 text-[0.8rem]">public</p>
                            @else
                                <p class="text-indigo-400 text-[0.8rem]">private</p>
                            @endif
                        </div>
                        <p class="font-thin text-[0.8rem] whitespace-normal text-wrap truncate">
                            @if (isset($expandedDescriptions[$prompt->id]))
                                {{ $prompt->description }}
                                <button wire:click="toggleDescription({{ $prompt->id }})" class="text-indigo-400 ml-2">Show less</button>
                            @else
                                {{ Str::limit($prompt->description, 50) }}
                                <button wire:click="toggleDescription({{ $prompt->id }})" class="text-indigo-400 ml-2">Read more</button>
                            @endif
                        </p>
                        <p class="font-thin text-[0.8rem]">{{ $prompt->content}}</p>
                        <p class="text-[0.7rem] text-gray-200 mt-1 flex flex-row items-center gap-2 w-[30%]">
                            <span>total likes {{ $prompt->likes->count() }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-hand-thumbs-up ml-auto" viewBox="0 0 16 16">
                                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                            </svg>
                        </p>
                        <p class="text-[0.7rem] text-gray-200 mt-1 flex flex-row items-center gap-2 w-[30%]">
                            <span>total hearts {{ $prompt->favorites->count() }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-heart ml-auto" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                            </svg>
                        </p>
                        <p class="font-thin text-[0.8rem] mt-2 text-[#a48ece]">{{ $prompt->created_at}}</p>
                    </div>
                @endforeach
            </div>
            <div class="my-8">
                {{ $prompts->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </section>

    @if ($flashMessage && $isMessageVisible)
        <div class="text-green-500 text-sm absolute right-2 bottom-4 transform -translate-x-1/2 bg-white p-3 shadow-md rounded-md z-10" wire:click="dismissFlashMessage">
            {{ $flashMessage }}
        </div>
    @endif
</main>