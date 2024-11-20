<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Prompts</title>
    <style>
        .prompt {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Search Prompts by Title</h1>
    <input type="text" id="search-query" placeholder="Enter title to search">
    <button onclick="searchPrompts()">Search</button>

    <h2>Search Results:</h2>
    <div id="search-results"></div>

    <script>
        async function searchPrompts() {
    const query = document.getElementById('search-query').value;
    console.log('Initiating search with query:', query);

    try {
        const response = await fetch(`/search-prompts-results?query=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        });

        console.log('Response status:', response.status);

        if (!response.ok) {
            console.error('Failed to fetch search results. Status:', response.status);
            const errorText = await response.text();
            console.error('Error details:', errorText);
            throw new Error('Failed to fetch search results');
        }

        const data = await response.json();
        console.log('Received search results:', data);

        displaySearchResults(data.prompts);
    } catch (error) {
        console.error('Error occurred during search:', error);
        alert('Error performing search. Please check the console for more details.');
    }
}

function displaySearchResults(prompts) {
    const resultsContainer = document.getElementById('search-results');
    resultsContainer.innerHTML = '';

    if (prompts.length === 0) {
        resultsContainer.innerHTML = '<p>No prompts found.</p>';
        return;
    }

    prompts.forEach(prompt => {
        const promptDiv = document.createElement('div');
        promptDiv.className = 'prompt';
        promptDiv.innerHTML = `
            <h3>${prompt.title}</h3>
            <p>${prompt.description || 'No description available'}</p>
        `;
        resultsContainer.appendChild(promptDiv);
    });
}

    </script>
</body>
</html>
