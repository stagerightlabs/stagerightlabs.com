<div {{ $attributes }} x-data="{ mobileMenuVisible: false, profileMenuVisible: false }">
  <div class="mx-auto px-2 sm:px-4 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex items-center px-2 lg:px-0">
        <div class="flex-shrink-0 flex items-center">
          <a href="/" class="flex items-center">
            <x-logo class="h-12 lg:h-16" />
            <h1 class="text-4xl text-red-800 ml-4 hidden lg:block">
              Stage Right Labs
            </h1>
          </a>
        </div>
        {{-- Desktop Navigation Menu --}}
        <div class="hidden lg:block lg:ml-6">
          <x-header.menu class="flex" />
          {{-- <nav class="flex">
            <a href="#" class="px-3 py-2 rounded-md text-sm leading-5 font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">About</a>
            <a href="#" class="ml-4 px-3 py-2 rounded-md text-sm leading-5 font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Open Source</a>
            <a href="#" class="ml-4 px-3 py-2 rounded-md text-sm leading-5 font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Decks</a>
            <a href="#" class="ml-4 px-3 py-2 rounded-md text-sm leading-5 font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Contact</a>
          </nav> --}}
        </div>
      </div>
      {{-- Search --}}
      {{-- <x-header.search /> --}}
      {{-- Mobile menu button --}}
      <x-header.mobile-button />
      {{-- User Account --}}
      @auth
        <x-header.account />
      @endauth
    </div>
  </div>

  {{-- Mobile Menu --}}
  <x-header.mobile />
</div>
