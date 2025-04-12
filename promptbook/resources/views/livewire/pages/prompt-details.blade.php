@props(['prompt'])

<main class="h-5/6 w-full mx-auto ">
    <section class="rounded-2xl sm:w-3/4 my-[5%] max-w-3/4 h-auto grid grid-cols-1 sm:grid-rows-1 place-content-center place-items-center sm:max-w-[30%] mx-auto text-black m-7">
        <div class="p-4 mt-8 w-full text-white">
            <h1 class="font-semibold text-4xl text-start">{{ $prompt->title }}</h1>

            <div class="bg-zinc-800 p-3 w-full h-auto border-[0.2px] border-zinc-700 rounded-md mt-5 grid grid-cols-2 px-8">
                <div class="my-[15%]">
                    <p class="font-bold text-nowrap my-2">Prompt Information</p>
                    <p class="font-light text-md break-words">{{ $prompt->description }} fdnjdfkndgjkhgbnhjikdfgbwwwwwwwwwwwwwwwwwwwwwwwwwwghhjvbgd</p>
                </div>
                <div class="w-1/2"></div>
            </div>
        </div>
    </section>
</main>