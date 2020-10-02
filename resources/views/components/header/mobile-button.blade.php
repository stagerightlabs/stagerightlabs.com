<div class="flex lg:hidden">
  @unless (app()->environment('production'))
    <div class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-pink-100 text-pink-800 mr-2">
      {{ ucwords(app()->environment())}}
    </div>
  @endunless
  <button
    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-cool-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
    aria-label="Main menu"
    aria-expanded="false"
    @click="mobileMenuVisible = !mobileMenuVisible"
  >
    {{--  Icon when menu is closed. --}}
    <x-heroicon-s-menu
      class="h-6 w-6"
      x-bind:class="{ 'hidden': mobileMenuVisible, 'block': !mobileMenuVisible }"
    />
    {{-- Icon when menu is open. --}}
    <x-heroicon-s-x
      class="hidden h-6 w-6"
      x-bind:class="{ 'hidden': !mobileMenuVisible, 'block': mobileMenuVisible }"
    />
  </button>
</div>
