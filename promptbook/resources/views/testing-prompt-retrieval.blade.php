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
            container.innerHTML = ''; // Clear existing prompts
            prompts.forEach(prompt => {
                const promptDiv = document.createElement('div');
                promptDiv.className = 'prompt';
                promptDiv.innerHTML = `
                    <div id="prompt-${prompt.id}">
                        <h3>${prompt.title}</h3>
                        <p><strong>Description:</strong> ${prompt.description || 'No description'}</p>
                        <p><strong>Content:</strong> ${prompt.content}</p>
                        <p><strong>Uploaded by:</strong> ${prompt.user ? prompt.user.name : 'Unknown'}</p>
                        <p><strong>Public:</strong> ${prompt.is_public ? 'Yes' : 'No'}</p>
                        ${prompt.user_id === authenticatedUserId ? `
                            <button onclick="togglePublicity(${prompt.id})">Toggle Publicity</button>
                            <button onclick="deletePrompt(${prompt.id}, '${containerId}')">Delete</button>
                            <button onclick="editPrompt(${prompt.id})" id="edit-button-${prompt.id}">Edit</button>
                        ` : ''}
                    </div>
                `;
                container.appendChild(promptDiv);
            });
        }

        async function editPrompt(promptId) {
            const promptContainer = document.getElementById(`prompt-${promptId}`);
            const editButton = document.getElementById(`edit-button-${promptId}`);
            
            // Check if we are in edit mode
            if (editButton.innerText === 'Edit') {
                // Change fields to input elements with current values
                const title = promptContainer.querySelector('h3').innerText;
                const description = promptContainer.querySelector('p:nth-of-type(1)').innerText.replace('Description: ', '');
                const content = promptContainer.querySelector('p:nth-of-type(2)').innerText.replace('Content: ', '');
                
                promptContainer.innerHTML = `
                    <input type="text" id="edit-title-${promptId}" value="${title}" /><br>
                    <textarea id="edit-description-${promptId}">${description}</textarea><br>
                    <textarea id="edit-content-${promptId}">${content}</textarea><br>
                    <button onclick="savePrompt(${promptId})">Save</button>
                    <button onclick="cancelEdit(${promptId})">Cancel</button>
                `;
            }
        }

        async function savePrompt(promptId) {
            const title = document.getElementById(`edit-title-${promptId}`).value;
            const description = document.getElementById(`edit-description-${promptId}`).value;
            const content = document.getElementById(`edit-content-${promptId}`).value;

            try {
                const response = await fetch(`/prompts/${promptId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ title, description, content })
                });

                if (!response.ok) {
                    throw new Error('Failed to save prompt');
                }

                const data = await response.json();
                alert(data.message);
                
                // Reload the prompts after saving
                fetchPrompts('/prompts/my-prompts', 'my-prompts', myPromptsPage, true);
            } catch (error) {
                console.error(error);
                alert('Error saving prompt.');
            }
        }

        function cancelEdit(promptId) {
            fetchPrompts('/prompts/my-prompts', 'my-prompts', myPromptsPage, true);
        }

        async function deletePrompt(promptId, containerId) {
            if (!confirm('Are you sure you want to delete this prompt?')) return;

            try {
                const response = await fetch(`/prompts/${promptId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to delete prompt');
                }

                const data = await response.json();
                alert(data.message);

                fetchPrompts('/prompts/my-prompts', 'my-prompts', myPromptsPage, true);
            } catch (error) {
                console.error(error);
                alert('Error deleting prompt.');
            }
        }

        fetchPrompts('/prompts/my-prompts', 'my-prompts', myPromptsPage, true);
        fetchPrompts('/prompts/all-prompts', 'all-prompts', allPromptsPage, true);
    </script>
</body>
</html>
