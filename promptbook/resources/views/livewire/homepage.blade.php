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

        <section class="relative bg-cover bg-center w-full h-[100dvh]" style="background-image: url('https://img.freepik.com/premium-photo/laptop-with-many-books-inside-symbolizing_912787-489.jpg'); background-size: cover; background-repeat: no-repeat;">
            <div class="absolute inset-0 bg-gradient-to-r opacity-70 from-gray-800 via-[#0e3086cc] to-[#7c72a7cc] z-2"></div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 place-items-center place-content-center w-[90%] mx-auto h-full z-10">
                <div class="grid grid-cols-1 grid-rows-3 grid-flow-col place-content-center items-center text-center bg-white bg-opacity-95 rounded-md shadow-lg sm:h-60 h-full w-3/4 sm:py-4 py-7 hover:scale-[1.025] hover:bg-opacity-95 transition-all duration-300 ease-in-out">
                    <div class="font-bold text-lg h-full relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h1 class="absolute sm:top-1 top-[-1rem] font-bold font-mono right-5 text-[1.1rem] max-w-56 w-fit truncate whitespace-nowrap">Create your own prompt</h1>
                            <div class="absolute left-0 right-0 h-[1px] bg-gray-900 bg-opacity-30"></div>
                            
                            <div class="w-[50px] h-[50px] bg-gradient-to-r from-sky-700 to-green-600 rounded-full flex items-center justify-center shadow-md absolute left-8">
                                <img class="object-contain w-[65%] h-[65%]" src="{{ asset('assets/svg/add-icon.svg') }}" alt="create-icon">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-sm px-5 flex flex-col h-1/2 gap-9">
                        <h2 class="text-start text-[1rem]">You can make your own prompts and view them or share them with others</h2>
                        @component('components.go-to-redirect', ['route' => route('prompts.create')])
                        @endcomponent
                    </div>
                </div>

                <div class="grid grid-cols-1 grid-rows-3 grid-flow-col place-content-center items-center text-center bg-white bg-opacity-85 rounded-md shadow-lg sm:h-60 h-full w-3/4 sm:py-4 py-7 hover:scale-[1.025] hover:bg-opacity-95 transition-all duration-300 ease-in-out">
                    <div class="font-bold text-lg h-full relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h1 class="absolute sm:top-1 top-[-1rem] font-bold font-mono right-5 text-[1.1rem] max-w-56 w-fit truncate whitespace-nowrap">View your own prompts</h1>
                            <div class="absolute left-0 right-0 h-[1px] bg-gray-900 bg-opacity-30"></div>
                            
                            <div class="w-[50px] h-[50px] bg-gradient-to-r from-red-700 to-orange-600 rounded-full flex items-center justify-center shadow-md absolute left-8">
                                <img class="object-contain w-[65%] h-[65%]" src="{{ asset('assets/svg/view-prompts-icon.svg') }}" alt="create-icon">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-sm px-5 flex flex-col h-1/2 gap-9">
                        <h2 class="text-start text-[1rem]">Here you can view or modify your own prompts to your liking</h2>
                        @component('components.go-to-redirect', ['route' => route('prompts.view')])
                        @endcomponent
                    </div>
                </div>

                <div class="grid grid-cols-1 grid-rows-3 grid-flow-col place-content-center items-center text-center bg-white bg-opacity-85 rounded-md shadow-lg sm:h-60 h-full w-3/4 sm:py-4 py-7 hover:scale-[1.025] hover:bg-opacity-95 transition-all duration-300 ease-in-out">
                    <div class="font-bold text-lg h-full relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h1 class="absolute sm:top-1 top-[-1rem] font-bold font-mono right-5 text-[1.1rem] max-w-56 w-fit truncate whitespace-nowrap">Visit peoples prompts</h1>
                            <div class="absolute left-0 right-0 h-[1px] bg-gray-900 bg-opacity-30"></div>
                            
                            <div class="w-[50px] h-[50px] bg-gradient-to-r from-yellow-600 to-lime-400 rounded-full flex items-center justify-center shadow-md absolute left-8">
                                <img class="object-contain w-[65%] h-[65%]" src="{{ asset('assets/svg/team-icon.svg') }}" alt="create-icon">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-sm px-5 flex flex-col h-1/2 gap-9">
                        <h2 class="text-start text-[1rem]">View other peoples prompts and take inspiration from them in the feed</h2>
                        @component('components.go-to-redirect', ['route' => route('prompts.feed')])
                        @endcomponent
                    </div>
                </div>
            </div>
        </section>
        
        
        <section class="bg-sky-800 w-full h-[110dvh]">
            
        </section>
    </main>
</div>