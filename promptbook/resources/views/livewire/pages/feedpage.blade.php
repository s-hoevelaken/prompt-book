@props(['users'])

<main class="h-5/6 w-full mx-auto ">
    {{-- header section --}}
    <section class="sm:w-[85%] sm:h-16 mt-20 mx-auto">
        <div class="flex flex-col my-8 justify-center text-white items-center h-full w-full gap-6">
            <h1 class="font-bold text-2xl max-w-[50%] text-center">A list of the best online prompts to make your ai even better then it already is</h1>
            <div class="w-[30%]">
                <form action="">
                    <input 
                        class="border-[1.5px] border-indigo-700 rounded-md bg-gray-800 bg-opacity-40 w-full focus:ring-0 focus:outline-none focus:border-indigo-400 focus:border-[1.5px] transition-all duration-300 ease-in-out" 
                        type="search" 
                        name="search-prompt" 
                        id="search-prompt" 
                        placeholder="search for a prompt . . ."
                        wire:model.live="search"
                    >
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
                    <div class="w-full prompt-card-bg p-3 rounded-md h-auto overflow-y-scroll max-h-36 shadow-md shadow-purple-700 hover:scale-[1.025] transition-all duration-300 ease-in-out">
                        <div class="flex flex-col items-start justify-start leading-5 mb-3">
                            <h1 class="font-bold text-[1rem]">{{ $user->title }}</h1>
                            @if ($user->is_public == 1)
                                <p class="text-indigo-400 text-[0.8rem]">public</p>
                            @else
                                <p class="text-indigo-400 text-[0.8rem]">private</p>
                            @endif
                        </div>
                        
                        <p class="font-thin text-[0.8rem]">
                            @if (isset($expandedDescriptions[$user->id]))
                            {{ $user->description }}
                            <button 
                                wire:click="toggleDescription({{ $user->id }})" 
                                    class="text-indigo-400 ml-2">
                                    Show less
                                </button>
                            @else
                                {{ Str::limit($user->description, 50) }}
                                @if (strlen($user->description) > 50)
                                    <button 
                                        wire:click="toggleDescription({{ $user->id }})" 
                                        class="text-indigo-400 ml-2">
                                        Read more
                                    </button>
                                @endif
                                <div class="flex flex-row items-center justify-start gap-1 my-1">
                                    <span wire:click="toggleLike({{ $user->id }})" class="cursor-pointer hover:scale-[1.1] transition-transform">
                                        @if ($user->isLikedBy(auth()->id()))
                                            <!-- Full Like SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                                <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                              </svg>
                                              
                                        @else
                                            <!-- Empty Like SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                            </svg>
                                        @endif
                                    </span>
                        
                                    <!-- Favourite Button -->
                                    <span wire:click="toggleFavourite({{ $user->id }})" class="cursor-pointer hover:scale-[1.1] transition-transform">
                                        @if ($user->isFavouritedBy(auth()->id()))
                                            <!-- Full Heart SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                            </svg>                                        
                                        @else
                                            <!-- Empty Heart SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                            </svg>
                                        @endif
                                    </span>
                                </div>
                            @endif
                            </p>
                        
                        <p class="font-thin text-[0.8rem] mt-2 text-[#a48ece]">{{ $user->created_at }}</p>
                    </div>
                @endforeach
            </div>
            <div class="my-8">
                {{ $users->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </section>
</main>