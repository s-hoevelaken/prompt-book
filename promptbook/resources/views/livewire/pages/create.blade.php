<main class="h-5/6 w-full mx-auto ">
    <form class="rounded-lg bg-zinc-800 flex flex-col sm:w-2/4 max-w-[80%] h-auto my-[5%] grid-rows-2 sm:grid-cols-6 sm:grid-rows-1 place-content-center place-items-center sm:max-w-[40%] mx-auto text-white m-7 shadow-md shadow-black" action="{{ route('prompts.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="w-full text-nowrap p-4">
            <h1 class="font-semibold text-xl">Maak een nieuwe Prompt aan</h1>
        </div>
        <div class="border-b-[1.5px] border-zinc-600 w-full mb-4"></div>
        
        <div class="w-[90%] mx-auto mb-1">
            @error('title')
                <p class="text-thin text-red-500 text-[0.85rem] absolute">{{ $message }}</p>
            @enderror
            <label class="relative text-sm top-7 left-3 text-gray-300 font-medium" for="title-input">Title (required)</label>
            <div id="maxlength-indicator" class="hidden w-[99%] relative top-[4.5rem] text-xs">
                <div class="absolute right-0 bottom-0 text-zinc-400">
                    0/100
                </div>
            </div>
            <input 
                class="bg-transparent focus:border-[2px] focus:border-white hover:border-white rounded-lg border-[1px] border-zinc-600 focus:outline-none focus:ring-0 w-full h-20 placeholder:text-zinc-500 placeholder:font-normal" 
                id="title-input"
                type="text"
                name="title"
                placeholder="Add title"
                maxlength="100"
                onfocus="showMaxLength(this)"
                onblur="hideMaxLength(this)"
            >
        </div>

        <div class="w-[90%] mx-auto mb-5">
            @error('description')
                <p class="text-thin text-red-500 text-[0.85rem] absolute">{{ $message }}</p>
            @enderror
            <label class="relative text-sm top-7 left-3 text-gray-300 font-medium" for="description-input">Description</label>
            <div id="maxlength-indicator" class="hidden w-[99%] relative top-[7.5rem] text-xs">
                <div class="absolute right-0 bottom-0 text-zinc-400">
                    0/300
                </div>
            </div>
            <input 
                class="bg-transparent focus:border-[2px] focus:border-white hover:border-white rounded-lg border-[1px] border-zinc-600 focus:outline-none focus:ring-0 items-start text-start align-top w-full h-32 placeholder:relative placeholder:bottom-6 placeholder:text-zinc-500 placeholder:font-normal" 
                id="description-input"
                type="text"
                name="description"
                placeholder="Add description"
                maxlength="300"
                onfocus="showMaxLength(this)"
                onblur="hideMaxLength(this)"
            >
        </div>

        <div class="w-[90%] mx-auto mb-5 flex flex-row justify-start items-center gap-4">
            <div class="flex items-start justify-start flex-col w-1/4 gap-0">
                <h1 class="text-nowrap absolute">Publicity and Output Format</h1>

                <label class="text-sm text-zinc-400 font-medium relative top-6 left-3 mt-3" for="publicity-toggle">publicity</label>
                <select name="is_public" id="" class="bg-transparent focus:border-[2px] focus:border-white hover:border-white rounded-lg border-[1px] border-zinc-600 focus:outline-none focus:ring-0 items-end text-start w-full h-14 " >
                    <option value="public" class="bg-zinc-800 text-gray-300">Public</option>
                    <option value="private" class="bg-zinc-800 text-gray-300">Private</option>
                </select>
            </div>

            <div class="flex items-start justify-start flex-col w-3/4 gap-0">
                <label class="text-sm text-zinc-400 font-medium relative top-6 left-3 mt-3" for="publicity-toggle">Output Format</label>
                <select name="output_format" id="" class="bg-transparent focus:border-[2px] focus:border-white hover:border-white rounded-lg border-[1px] border-zinc-600 focus:outline-none focus:ring-0 items-end text-start w-full h-14 " >
                    <option value="json" class="bg-zinc-800 text-gray-300">JSON</option>
                    <option value="markdown" class="bg-zinc-800 text-gray-300">Markdown</option>
                    <option value="html" class="bg-zinc-800 text-gray-300">HTML</option>
                </select>
            </div>
        </div>

        <div class="w-[90%] mx-auto mb-8 flex flex-col gap-3">
            <div>
                <label class="text-md text-gray-300 font-medium" for="file-input">Content (Optional)</label>
                <p class="text-sm text-zinc-400 font-medium mb-3">Choose any content format like (Markdown, Image, Codeblock)</p>
            </div>
            <div>
                <!-- Hidden file input -->
                <input 
                    id="file-input"
                    type="file"
                    name="content"
                    accept=".txt, .md, .json, .html, .jpg, .jpeg, .png"
                    class="hidden"
                >
                <!-- Custom styled button -->
                <label 
                    for="file-input" 
                    class="bg-zinc-500 bg-opacity-30 text-white font-medium py-2 px-4 rounded-3xl cursor-pointer hover:scale-105 transition-all duration-300 ease-in-out text-center hover:bg-zinc-600"
                >
                    Upload File
                </label>
                <!-- Display selected file name -->
                <span id="file-name" class="text-sm text-gray-400 mt-2"></span>
            </div>
        </div>

        <button class="bg-gradient-to-r from-blue-600 to-sky-500 max-w-[85%] w-full mx-auto shadow-md p-3 rounded-lg font-bold font-sans mb-5 hover:scale-105 transition-all duration-300 ease-in-out focus:text-white" type="submit">Submit Prompt</button>
    </from>
</main>

<script>
    function showMaxLength(input) {
        const indicator = input.parentElement.querySelector('#maxlength-indicator');
        indicator.classList.remove('hidden');
    }

    function hideMaxLength(input) {
        const indicator = input.parentElement.querySelector('#maxlength-indicator');
        indicator.classList.add('hidden');
    }
</script>