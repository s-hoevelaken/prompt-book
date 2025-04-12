@props(['prompt'])

<main class="h-5/6 w-full mx-auto ">
    <section class="rounded-2xl bg-zinc-600 sm:w-2/4 my-[5%] max-w-3/4 h-auto grid grid-cols-1 sm:grid-rows-1 place-content-center place-items-center sm:max-w-[60%] mx-auto text-black m-7">
        <div class="border-b-[1.5px] border-gray-700 w-full h-auto pb-2 pt-4 flex flex-row justify-start items-center gap-2 px-4">
            @if ($prompt->categories)
                @foreach($prompt->categories as $category)
                    <div 
                        class="py-1 px-2 w-auto ml-3 rounded-l-2xl rounded-r-2xl font-medium shadow-md shadow-gray-600"
                        style="background-color: {{ $category->color }};"
                    >
                        {{ $category->name }}
                    </div>
                @endforeach
            @endif
        </div>
        <div class="p-4 mt-8">
            <div class="flex justify-center items-center flex-col gap-2">
                <h1 class="text-3xl font-bold text-gray-200">{{ $prompt->title }}</h1>
                <p class="text-gray-300 text-sm">{{ $prompt->description }}</p>
            </div>
    
            {{-- create a section that shows a code snippet wich transforms the prompt->content into a json format --}}
            <div class="w-full h-auto bg-zinc-900 rounded-lg p-4 mt-4">
                <x-code-snippet :prompt="$prompt"></x-code-snippet>
            </div>
        </div>
    </section>
</main>