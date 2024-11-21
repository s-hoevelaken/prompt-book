<div>
    <main>
        <section class="bg-gradient-to-r from-[#0f1e43] to-[#3c326b] w-full h-screen border-b-[1.5px] border-black">
            <div class="flex sm:flex-row flex-col sm:justify-around justify-around items-center w-[75%] mx-auto h-full p-4 text-white my-0">
                <div class="sm:flex-1 grid md:grid-cols-1 place-content-start place-items-start items-start sm:h-[50%] sm:max-w-[70%] max-w-[90%] gap-4 ">
                    <h1 class="sm:text-[2.25rem] text-3xl font-bold">Generate creative prompts with ease for any project.</h1>

                    <p class="roboto-medium">A guide to create simplistic and efficient prompts to receive better results.</p>
                </div>

                <div class="relative flex-shrink-0 max-w-[80%] min-w-[40%]">
                    <div class="absolute inset-0 flex justify-center items-center z-0">
                        <div class="bg-sky-600 rounded-full w-[160%] h-[100%] shadow-md shadow-black">
                    </div>
                </div>

                <img class="relative object-cover w-full z-4" src="https://png.pngtree.com/png-vector/20240313/ourmid/pngtree-artificial-intelligence-support-service-png-image_11941915.png" alt="prompt-robot">

                </div>           
            </div>
        </section>

        <section class="relative bg-cover bg-center w-full sm:h-[120vh] h-[170dvh]" style="background-image: url('https://img.freepik.com/premium-photo/laptop-with-many-books-inside-symbolizing_912787-489.jpg'); background-size: cover; background-repeat: no-repeat;">
            <div class="absolute inset-0 bg-gradient-to-r opacity-70 from-gray-800 via-[#0e3086cc] to-[#7c72a7cc] z-2"></div>

            <div class="sm:grid flex flex-col sm:grid-cols-3 sm:gap-4 gap-8 sm:place-content-center sm:place-items-center justify-center items-center sm:w-[90%] w-[80%] mx-auto h-full sm:h-full z-10">
                <div class="bg-black text-white rounded-xl sm:h-[60%] h-[50vh] sm:w-[80%] w-[90%] z-10 grid grid-cols-1 grid-rows-5">
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

                <div class="bg-black text-white rounded-xl sm:h-[60%] h-[50vh] sm:w-[80%] w-[90%] z-10 grid grid-cols-1 grid-rows-5">
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

                <div class="bg-black text-white rounded-xl sm:h-[60%] h-[50vh] sm:w-[80%] w-[90%] z-10 grid grid-cols-1 grid-rows-5">
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
        
        
        <section class="bg-sky-800 w-full h-[110dvh]">
            
        </section>
    </main>
</div>