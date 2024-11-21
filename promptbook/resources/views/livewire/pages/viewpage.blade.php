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
                    <div class="w-full prompt-card-bg p-3 rounded-md h-auto overflow-y-scroll max-h-36 shadow-md shadow-purple-700 hover:scale-[1.025] transition-all duration-300 ease-in-out">
                        <div class="flex flex-col items-start justify-start leading-5 mb-3">
                            <h1 class="font-bold text-[1rem]">{{ $prompt->title}}</h1>
                            @if ($prompt->is_public == 1)
                                <p class="text-indigo-400 text-[0.8rem]">public</p>
                            @else
                                <p class="text-indigo-400 text-[0.8rem]">private</p>
                            @endif
                        </div>
                        <p class="font-thin text-[0.8rem]">{{ $prompt->description}}</p>
                        </br>
                        <p class="font-thin text-[0.8rem]">{{ $prompt->content}}</p>
                        <p class="font-thin text-[0.8rem] mt-2 text-[#a48ece]">{{ $prompt->created_at}}</p>
                    </div>
                @endforeach
            </div>
            <div class="my-8">
                {{ $prompts->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </section>
    
    
</main>