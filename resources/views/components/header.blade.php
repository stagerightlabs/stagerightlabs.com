<div {{ $attributes }} x-data="{ mobileMenuVisible: false, profileMenuVisible: false }">
  <div class="mx-auto px-2 sm:px-4 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex items-center px-2 lg:px-0">
        <div class="flex-shrink-0 flex items-center">
          <a href="/" class="flex items-center">
            <x-logo class="h-12 lg:h-16" />
            <h1 class="text-4xl text-red-800 ml-4 hidden xl:block">
              Stage Right Labs
            </h1>
          </a>
        </div>
        {{-- Desktop Navigation Menu --}}
        <div class="hidden lg:block lg:ml-6">
          <x-header.menu class="flex" />
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
