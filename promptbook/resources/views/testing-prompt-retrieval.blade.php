<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Prompt Retrieval</title>
    <style>
        .prompt {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>My Prompts</h1>
    <div id="my-prompts"></div>
    <button id="load-more-my-prompts" onclick="loadMorePrompts('/prompts/my-prompts', 'my-prompts')">Load More My Prompts</button>

    <h1>All Public Prompts</h1>
    <div id="all-prompts"></div>
    <button id="load-more-all-prompts" onclick="loadMorePrompts('/prompts/all-prompts', 'all-prompts')">Load More Public Prompts</button>

    <script>
        let myPromptsPage = 1;
        let allPromptsPage = 1;
        const authenticatedUserId = {{ Auth::id() }};

        async function fetchPrompts(url, containerId, page, initialLoad = false) {
            try {
                const response = await fetch(`${url}?page=${page}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch prompts');
                }
                const data = await response.json();
                displayPrompts(data.data, containerId);
                if (initialLoad && data.data.length === 0) {
                    document.getElementById(`load-more-${containerId}`).style.display = 'none';
                }
                return data.next_page_url ? true : false;
            } catch (error) {
                console.error(error);
                document.getElementById(containerId).innerHTML += '<p>Error loading prompts.</p>';
                return false;
            }
        }

        function displayPrompts(prompts, containerId) {
            const container = document.getElementById(containerId);
            prompts.forEach(prompt => {
                const promptDiv = document.createElement('div');
                promptDiv.className = 'prompt';
                promptDiv.innerHTML = `
                    <h3>${prompt.title}</h3>
                    <p><strong>Description:</strong> ${prompt.description || 'No description'}</p>
                    <p><strong>Content:</strong> ${prompt.content}</p>
                    <p><strong>Uploaded by:</strong> ${prompt.user ? prompt.user.name : 'Unknown'}</p>
                    <p><strong>Public:</strong> ${prompt.is_public ? 'Yes' : 'No'}</p>
                    ${prompt.user_id === authenticatedUserId ? `
                        <button onclick="togglePublicity(${prompt.id})">Toggle Publicity</button>
                    ` : ''}
                `;
                container.appendChild(promptDiv);
            });
        }

        async function togglePublicity(promptId) {
            try {
                const response = await fetch(`/prompts/${promptId}/toggle-publicity`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });
                
                if (!response.ok) {
                    throw new Error('Failed to toggle publicity');
                }

                const data = await response.json();
                alert(data.message);
            } catch (error) {
                console.error(error);
                alert('Error toggling publicity.');
            }
        }

        async function loadMorePrompts(url, containerId) {
            if (containerId === 'my-prompts') {
                myPromptsPage++;
                const moreData = await fetchPrompts(url, containerId, myPromptsPage);
                if (!moreData) {
                    document.getElementById('load-more-my-prompts').style.display = 'none';
                }
            } else if (containerId === 'all-prompts') {
                allPromptsPage++;
                const moreData = await fetchPrompts(url, containerId, allPromptsPage);
                if (!moreData) {
                    document.getElementById('load-more-all-prompts').style.display = 'none';
                }
            }
        }

        fetchPrompts('/prompts/my-prompts', 'my-prompts', myPromptsPage, true);
        fetchPrompts('/prompts/all-prompts', 'all-prompts', allPromptsPage, true);
    </script>
</body>
</html>
