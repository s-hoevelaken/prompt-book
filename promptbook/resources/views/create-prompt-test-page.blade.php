<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prompt Testing Page</title>
</head>
<body>
    <h1>Create a New Prompt</h1>
    <form action="{{ url('/prompts') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        
        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content" required></textarea>
        </div>
        
        <div>
            <label for="is_public">Make Public</label>
            <input type="checkbox" name="is_public" id="is_public">
        </div>
        
        <button type="submit">Submit Prompt</button>
    </form>
</body>
</html>
