@props(['route'])

<div class="flex flex-row items-center justify-start w-[30%] gap-0 transform hover:translate-x-2 transition-all duration-300 ease-in-out text-[1.1rem] text-white">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
      </svg>
    <button class="hover:cursor-pointer p-2 text-white mt-auto rounded-md py-2 px-1"><a href="{{ $route }}">Go to</a></button>
</div>