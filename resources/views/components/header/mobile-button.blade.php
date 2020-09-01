<div class="flex lg:hidden">
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
