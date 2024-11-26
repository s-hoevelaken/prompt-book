@extends('layouts.app')

@section('content')
<main class="h-5/6 w-full mx-auto ">
    @props(['prompt'])
    {{-- header section --}}
    <section class="rounded-3xl sm:w-full max-w-[80%] h-auto grid grid-cols-1 grid-rows-2 sm:grid-cols-6 sm:grid-rows-1 place-content-center place-items-center sm:max-w-[60%] mx-auto text-black m-7">
        <section class="w-full col-span-3 text-black h-full sm:max-h-[85%] bg-indigo-700 bg-opacity-90 sm:rounded-l-3xl grid grid-cols-1 place-items-center p-5">
            <form action="{{ route('prompts.update', ['id' => $prompt->id]) }}" class="mb-auto w-full" method="POST" novalidate>
                @csrf
                @method('PUT')
                <h1 class="text-center text-[1.75rem]">Edit prompt <strong>{{ $prompt->title }}</strong></h1>
                <div class="mt-2 mb-4 h-[2px] bg-black w-[95%] mx-auto"></div>

                <div class="grid grid-cols-1 gap-6 mt-3">
                    {{-- update title --}}
                    <div class="flex flex-col w-6/7 mx-3 justify-center">
                        <label class="font-bold" for="title">Title:</label>
                        <input class="bg-gray-900 border-0 rounded-md bg-opacity-75 w-3/6 text-white focus:ring-0 h-8 font-semibold valid:border-[2px] valid:border-green-600 group-invalid:border-[2px] group-invalid:border-red-600" type="text" name="title" id="title" required maxlength="55" value="{{ $prompt->title }}">
                        @error('title')
                            <p class="text-thin text-red-500 text-[0.85rem] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- update description --}}
                    <div class="flex flex-col w-6/7 mx-3 justify-center">
                        <label class="font-bold text-black" for="description">Description:</label>
                        <textarea class="w-5/6 bg-gray-900 bg-opacity-75 text-[0.8rem] focus:ring-0 text-white border-0 rounded-md valid:border-[1.5px] valid:border-green-600 min-h-[5rem] resize-y" name="description" id="description" required>{{ strip_tags($prompt->description) }}</textarea>
                        @error('description')
                            <p class="text-thin text-red-500 text-[0.85rem] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- update content --}}
                    <div class="flex flex-col w-6/7 mx-3 justify-center">
                        <label class="font-bold" for="content">Content:</label>
                        <textarea class="w-5/6 bg-gray-900 bg-opacity-75 text-[0.8rem] focus:ring-0  text-white border-0 rounded-md valid:border-[1.5px] valid:border-green-600" name="content" id="content" required>{{ strip_tags($prompt->content) }}</textarea>
                        @error('content')
                            <p class="text-thin text-red-500 text-[0.85rem] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- toggle publicity --}}
                    <div class="flex flex-row-reverse w-6/7 mx-4 justify-end gap-2 items-center ">
                        <label class="font-thin text-[0.9rem] mb-[0.1rem] text-teal-500" for="is_public">make prompt public</label>
                        <input class="bg-gray-900 border-0 rounded-md focus:ring-0 focus:border-0 focus:outline-none text-cyan-600 bg-opacity-75 w-5 h-5" type="checkbox" name="is_public" id="is_public">
                    </div>
                    
                    <button class="bg-gradient-to-r from-blue-600 to-sky-500 max-w-[85%] w-full mx-auto shadow-md p-3 rounded-lg font-bold font-sans mb-5 hover:scale-105 transition-all duration-300 ease-in-out focus:text-white" type="submit">Update Prompt</button>
                </form>
        </section>

        <section class="w-full col-span-3 h-[85%] sm:block hidden">
            <img class="rounded-r-3xl h-full" src="https://bpic.588ku.com/back_pic/23/03/21/a8755d7036793c3e28de67d5fb2c6952.png" alt="creating-image">
        </section>
    </section>
</main>
@endsection
