<main class="h-5/6 max-w-[85%] mx-auto my-12">
    <section class="bg-sky-700 bg-opacity-80 backdrop-blur-sm rounded-2xl w-full h-[35rem] shadow-lg shadow-black grid grid-cols-5 grid-rows-1 gap-3 place-content-center place-items-center p-6 sm:max-w-[70%] mx-auto mt-8 text-black">
        <section class="w-full col-span-3 text black h-[85%] px-6">
            <div class="grid grid-cols-1 place-content-start gap-9">
                <h1 class='text-4xl font-["Roboto", serif] font-extrabold'>Create a New Prompt</h1>

                <form action="{{ url('/prompts')}}" method="POST" class="flex flex-col gap-5">
                    <div class="flex flex-col justify-start items-start">
                        <label class="font-semibold" for="title">Prompt Title:</label>
                        <input class="h-8 rounded-md w-[45%] bg-gray-800 opacity-75 text-white outline-[3px] outline-black focus:border-none focus:ring-0 valid:outline-green-600 user-invalid:outline-red-600" type="text" name="title" id="title" required maxlength="30">
                    </div>

                    <div class="flex flex-col justify-start items-start">
                        <label class="font-semibold" for="title">Prompt Description:</label>
                        <input class="h-8 rounded-md w-[70%] bg-gray-800 opacity-75 text-white focus:ring-0 outline-[3px] outline-black valid:outline-green-600 user-invalid:outline-red-600" type="text" name="title" id="title" required>
                    </div>

                    <div class="flex flex-col justify-start items-start">
                        <label class="font-semibold" for="title">Prompt Content:</label>
                        <textarea class="overflow-hidden h-28 rounded-md max-w-[70%] w-full bg-gray-800 opacity-75 text-white focus:ring-0 outline-[3px] outline-black valid:outline-green-600 user-invalid:outline-red-600"  name="content" id="content" cols="40" rows="12"></textarea>
                    </div>
                </form>
            </div>
        </section>

        <section class="w-full col-span-2 h-[95%]">
            <img class="rounded-lg shadow-md ring-1 h-full" src="https://img.freepik.com/vetores-premium/design-de-desenvolvedor-web_24911-42695.jpg" alt="creating-image">
        </section>
    </section>

    {{-- <h1>Create a New Prompt</h1>
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
    </form> --}}
</main>
