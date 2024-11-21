<main class="h-5/6 w-full mx-auto ">
    <section class="rounded-3xl w-full h-auto shadow-lg shadow-black grid grid-cols-6 grid-rows-1 place-content-center place-items-center sm:max-w-[60%] mx-auto text-black m-14">
        <section class="w-full col-span-3 text-black h-full bg-indigo-700 bg-opacity-90 rounded-l-3xl grid grid-cols-1 place-items-center p-5">
            <form action="{{ route('prompts.store') }}" class="mb-auto w-full" method="POST" novalidate>
                @csrf
                <h1 class="text-center text-[1.75rem] font-bold">Create a Prompt</h1>
                <div class="mt-2 mb-4 h-[2px] bg-black w-[95%] mx-auto"></div>

                <div class="grid grid-cols-1 gap-6 mt-3">
                    <div class="flex flex-col w-6/7 mx-3 justify-center">
                        <label class="font-bold" for="title">Title:</label>
                        <input class="bg-gray-900 border-0 rounded-md bg-opacity-75 w-3/6 text-white focus:ring-0 h-8 font-semibold valid:border-[2px] valid:border-green-600 group-invalid:border-[2px] group-invalid:border-red-600" type="text" name="title" id="title" required maxlength="55">
                        @error('title')
                            <p class="text-thin text-red-500 text-[0.85rem] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col w-6/7 mx-3 justify-center">
                        <label class="font-bold text-black " for="description">Description:</label>
                        <textarea class="w-5/6 bg-gray-900 bg-opacity-75 text-[0.8rem] focus:ring-0 text-white border-0 rounded-md valid:border-[1.5px] valid:border-green-600" name="description" id="description" required></textarea>
                        @error('description')
                            <p class="text-thin text-red-500 text-[0.85rem] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col w-6/7 mx-3 justify-center">
                        <label class="font-bold" for="content">Content:</label>
                        <textarea class="w-5/6 bg-gray-900 bg-opacity-75 text-[0.8rem] focus:ring-0  text-white border-0 rounded-md valid:border-[1.5px] valid:border-green-600" name="content" id="content" required></textarea>
                        @error('content')
                            <p class="text-thin text-red-500 text-[0.85rem] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-row-reverse w-6/7 mx-4 justify-end gap-2 items-center ">
                        <label class="font-thin text-[0.9rem] mb-[0.1rem] text-teal-500" for="is_public">make prompt public</label>
                        <input class="bg-gray-900 border-0 rounded-md focus:ring-0 focus:border-0 focus:outline-none text-cyan-600 bg-opacity-75 w-5 h-5" type="checkbox" name="is_public" id="is_public">
                    </div>
                    
                    <button class="bg-gradient-to-r from-blue-600 to-sky-500 max-w-[85%] w-full mx-auto shadow-md p-3 rounded-lg font-bold font-sans mb-5 hover:scale-105 transition-all duration-300 ease-in-out focus:text-white" type="submit">Submit Prompt</button>
                </div>
            </form>
        </section>

        <section class="w-full col-span-3 h-full">
            <img class="rounded-r-3xl h-full" src="https://metainovacoes.com.br/wp-content/uploads/2021/06/computacao.jpg" alt="creating-image">
        </section>
    </section>
</main>
