<!-- filepath: c:\Users\Xander\Documents\portfolio\portfolio project\prompt-book\promptbook\resources\views\livewire\pages\search-results.blade.php -->
@props(['prompts'])

<main class="w-full mx-auto">
    <section class="sm:w-[85%] mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center text-white">Search Results</h1>
        @if ($prompts->isEmpty())
            <p class="text-center text-gray-300 mt-5">No prompts found for "{{ $query }}"</p>
        @else
            <ul class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($prompts as $prompt)
                    <li class="bg-gray-800 text-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold">{{ $prompt->title }}</h2>
                        <p class="text-sm mt-2">{{ $prompt->description }}</p>
                        <a href="{{ route('prompt.show', $prompt->id) }}" class="text-indigo-400 mt-4 inline-block">View Details</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</main>