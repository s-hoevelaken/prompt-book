@props(['prompts', 'favPrompts'])

<main class="h-5/6 w-full mx-auto text-white">
    <!-- Tab Buttons -->
    <div class="tabs w-full flex justify-center mt-5 gap-4">
        <button class="bg-gray-700 text-white px-4 py-2 rounded-md" onclick="showSection('your-prompts')">Your Prompts</button>
        <button class="bg-gray-700 text-white px-4 py-2 rounded-md" onclick="showSection('favorited-prompts')">Favorited Prompts</button>
    </div>

    <!-- Your Prompts Section -->
    <div id="your-prompts" class="mt-5">
        <h1 class="text-2xl mb-4">Your Prompts</h1>
        @foreach($prompts as $prompt)
            <div class="prompt border-[1.5px] border-white rounded-md p-4 mb-4">
                <h3 class="text-lg font-bold">{{ $prompt['title'] }}</h3>
                <p><strong>Description:</strong> {{ $prompt['description'] ?? 'No description' }}</p>
                <p><strong>Content:</strong> {{ $prompt['content'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Favorited Prompts Section -->
    <div id="favorited-prompts" class="mt-5" style="display: none;">
        <h1 class="text-2xl mb-4">Favorited Prompts</h1>
        @foreach($favPrompts as $prompt)
            <div class="prompt border-[1.5px] border-white rounded-md p-4 mb-4">
                <h3 class="text-lg font-bold">{{ $prompt['title'] }}</h3>
                <p><strong>Description:</strong> {{ $prompt['description'] ?? 'No description' }}</p>
                <p><strong>Content:</strong> {{ $prompt['content'] }}</p>
                <p><strong>Uploaded by:</strong> {{ $prompt['user']['name'] ?? 'Unknown' }}</p>
            </div>
        @endforeach
    </div>
</main>

<script>
    function showSection(sectionId) {
        // Hide both sections
        document.getElementById('your-prompts').style.display = 'none';
        document.getElementById('favorited-prompts').style.display = 'none';

        // Show the selected section
        document.getElementById(sectionId).style.display = 'block';
    }
</script>
