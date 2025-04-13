@props(['categories'])
<div>
    <main>
        <section class="bg-gradient-to-r from-indigo-700 via-teal-600 to-sky-500 w-full h-[50vh] border-b-[1.5px] border-black">
            <div class="flex flex-col justify-center items-center w-[60%] mx-auto h-full">
                <h1 class="text-white font-bold text-5xl">Creativity is a prompt away</h1>

                <p class="text-wrap text-white max-w-[50%] font-normal text-xl text-center mt-8">Our web page application provides simplistic and efficient prompts to get the best results from you AI model.</p>

                <form class="sm:w-[75%] w-full mb-1" wire:submit.prevent="updateSearch">
                    <div class="w-full mt-4 flex justify-center items-center">
                        <input 
                            class="border-none shadow-sm shadow-black border-zinc-700 bg-white rounded-3xl w-3/5 placeholder:font-normal placeholder:text-gray-500 text-black font-normal focus:border-none focus:outline-none focus:ring-0" 
                            type="search" 
                            wire:model.defer="search" 
                            placeholder="Search for a prompt"
                        >
                        <button 
                            class="p-3 text-white rounded-r-3xl font-bold font-sans hover:translate-x-2 transition-all duration-300 ease-in-out hover:text-sky-300 focus:text-white align-middle hover:cursor-pointer" 
                            type="submit">
                            Search
                        </button>
                    </div>
                </form>
                
                
                <ul class="flex flex-wrap gap-2 w-[60%] mt-8">
                    @foreach ($categories as $category)
                        <li class="text-white bg-zinc-800 rounded-2xl px-3 py-1 text-center">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
        <section class="bg-gradient-to-r bg-stone-900 w-full h-[50vh] border-b-[1.5px] border-black">
            <div class="flex flex-col justify-center items-center w-[95%] mx-auto h-full text-white">
                <ul class="flex flex-wrap gap-6 w-full justify-center mt-8">
                    @foreach ($categories as $category)
                        @if($loop->index < 6 && $category->image_url)
                            <li class="flex flex-col items-center text-nowrap">
                                <img src="{{ $category->image_url }}" alt="prompt-image-{{ $category->id }}" class=" w-60 h-44 object-cover rounded-md shadow-md shadow-black">
                                <p>{{ $category->name }}</p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="relative bg-cover bg-center w-full sm:h-[120vh] h-[170dvh]" style="background-image: url('https://img.freepik.com/premium-photo/laptop-with-many-books-inside-symbolizing_912787-489.jpg'); background-size: cover; background-repeat: no-repeat;">
            <div class="absolute inset-0 bg-gradient-to-r opacity-70 from-gray-800 via-[#0e3086cc] to-[#7c72a7cc] z-2"></div>

            <div class="sm:grid flex flex-col sm:grid-cols-3 sm:gap-4 gap-8 sm:place-content-center sm:place-items-center justify-center items-center sm:w-[90%] w-[80%] mx-auto h-full sm:h-full z-10">
                <div class="bg-black text-white rounded-xl sm:h-[60%] h-[50vh] sm:w-[80%] w-[90%] z-10 grid grid-cols-1 grid-rows-5 shadow-md shadow-black  hover:scale-[1.025] transition-all duration-300 ease-in-out">
                    <div class="relative row-span-3 overflow-hidden">
                        <img class="h-full w-full object-cover rounded-t-2xl" src="https://th.bing.com/th/id/OIP.V9B6C-vBjOXvhsmoL9kBKgHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain" alt="">
                        <div class="absolute inset-0 bg-green-600 opacity-20"></div>
                    </div>
                    <div class="row-span-1 relative">
                        <div class="absolute top-[-30px] left-0 right-0 bg-black text-white p-4 clip-diagonal rounded-b-2xl">
                            <div class="flex flex-col h-auto mt-5 sm:text-[1rem] text-[0.85rem]">
                                <p>You can make your own prompts and view them or share them with others.</p>

                                <div class="mt-7 w-full">
                                    @component('components.go-to-redirect', ['route' => route('prompts.create')])
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-black text-white rounded-xl sm:h-[60%] h-[50vh] sm:w-[80%] w-[90%] z-10 grid grid-cols-1 grid-rows-5 shadow-md shadow-black  hover:scale-[1.025] transition-all duration-300 ease-in-out">
                    <div class="relative row-span-3 overflow-hidden">
                        <img class="h-full w-full object-cover rounded-t-2xl" src="https://www.wpexplorer.com/wp-content/uploads/stockphotos-from-bigstock.jpg" alt="">
                        <div class="absolute inset-0 bg-blue-600 opacity-20"></div>
                    </div>
                    <div class="row-span-1 relative">
                        <div class="absolute top-[-30px] left-0 right-0 bg-black text-white p-4 clip-diagonal rounded-b-2xl">
                            <div class="flex flex-col h-auto mt-5 w-full sm:text-[1rem] text-[0.85rem]">
                                <p>Here you can view or modify your own prompts to your liking.</p>

                                <div class="mt-7">
                                    @component('components.go-to-redirect', ['route' => route('prompts.view')])
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-black text-white rounded-xl sm:h-[60%] h-[50vh] sm:w-[80%] w-[90%] z-10 grid grid-cols-1 grid-rows-5 shadow-md shadow-black hover:scale-[1.025] transition-all duration-300 ease-in-out">
                    <div class="relative row-span-3 overflow-hidden">
                        <img class="h-full w-full object-cover rounded-t-2xl" src="https://media.istockphoto.com/photos/social-media-picture-id1187661304?k=6&m=1187661304&s=170667a&w=0&h=8sIJhVynLiUTFi1ez0FO5cOchOL2jJDkbcQZb2EgQz8=" alt="">
                        <div class="absolute inset-0 bg-orange-600 opacity-20"></div>
                    </div>
                    <div class="row-span-1 relative">
                        <div class="absolute top-[-30px] left-0 right-0 bg-black text-white p-4 clip-diagonal rounded-b-2xl">
                            <div class="flex flex-col h-auto mt-5 sm:text-[1rem] text-[0.85rem]">
                                <p>View other peoples prompts and take inspiration from them in the feed.</p>
    
                                <div class="mt-7">
                                    @component('components.go-to-redirect', ['route' => route('prompts.feed')])
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        {{-- <section class="bg-sky-800 w-full h-[110dvh]">
            
        </section> --}}
    </main>
    <script>
        window.addEventListener('redirect', event => {
            window.location.href = event.detail.url;
        });
    </script>    
</div>