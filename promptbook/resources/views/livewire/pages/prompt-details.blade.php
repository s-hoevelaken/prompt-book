@props(['prompt'])

<main class="h-5/6 w-full mx-auto ">
    <section class="rounded-xl dark:bg-zinc-600 p-4 sm:w-full max-w-3/4 h-auto grid grid-cols-1 sm:grid-rows-1 place-content-center place-items-center sm:max-w-[60%] mx-auto text-white m-7">
        <h1 class="text-3xl mr-auto prompt-details-title">{{ $prompt->title }}</h1>

        {{-- create a section that shows a code snippet wich transforms the prompt->content into a json format --}}
        <div class="w-full h-auto bg-zinc-900 rounded-lg p-4 mt-4">
            <x-code-snippet :prompt="$prompt"></x-code-snippet>
        </div>
    </section>
</main>