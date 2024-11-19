@props(['prompts'])

<main class="h-5/6 w-full mx-auto ">
    <section class="rounded-3xl w-full h-auto shadow-lg grid grid-cols-1 grid-rows-1 place-content-center place-items-center sm:max-w-[60%] mx-auto text-white mt-10">
        <h1 class="mb-5">Your Prompts</h1>
        <div class="grid grid-cols-3 place-content-center gap-4">
            @foreach ($prompts as $prompt)
                <ul class="border-[1.5px] border-white rounded-md p-4">
                    <li><span class="font-bold text-white">Title: </span>{{ $prompt->title }}</li>
                    <li><span class="font-bold text-white">Description: </span>{{ $prompt->description }}</li>
                    <li><span class="font-bold text-white">Content: </span>{{ $prompt->content }}</li>
                    <li><span class="font-bold text-white">Status: </span>{{ $prompt->is_public }}</li>
                </ul>
            @endforeach
        </div>
    </section>
</main>
