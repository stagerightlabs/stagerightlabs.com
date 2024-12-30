{{-- https://github.com/stefanbauer/tailwindcss-breakpoint-detector/blob/master/resources/views/detector.blade.php --}}
<div
  class="fixed bottom-0 right-0 m-10 flex h-6 w-6 items-center justify-center rounded-md border-2 border-white bg-gray-600 p-6 text-lg font-bold uppercase text-white shadow-md sm:bg-red-500 md:bg-orange-500 lg:bg-green-500 xl:bg-blue-600 2xl:bg-purple-700"
  style="z-index: 9999"
>
  <div class="block sm:hidden md:hidden lg:hidden xl:hidden 2xl:hidden">xs</div>
  <div class="hidden sm:block md:hidden lg:hidden xl:hidden 2xl:hidden">sm</div>
  <div class="hidden sm:hidden md:block lg:hidden xl:hidden 2xl:hidden">md</div>
  <div class="hidden sm:hidden md:hidden lg:block xl:hidden 2xl:hidden">lg</div>
  <div class="hidden sm:hidden md:hidden lg:hidden xl:block 2xl:hidden">xl</div>
  <div class="hidden sm:hidden md:hidden lg:hidden xl:hidden 2xl:block">
    2xl
  </div>
</div>
