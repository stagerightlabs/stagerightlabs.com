<div
  class="hidden lg:hidden bg-cool-gray-700 mb-4"
  :class="{ 'block': mobileMenuVisible, 'hidden': !mobileMenuVisible }"
>
  {{-- Mobile Navigation Menu --}}
  <x-header.menu class="px-2 pt-2 pb-3" :mobile="true" />
  {{-- <nav class="">
    <a href="#" class="">Dashboard</a>
    <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-cool-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Team</a>
    <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-cool-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Projects</a>
    <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-cool-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Calendar</a>
  </nav> --}}
  @auth
  {{-- Mobile Profile Options --}}
  <div class="pt-4 pb-3 border-t border-cool-gray-400">
    <div class="px-2">
      {{-- <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Your Profile</a>
      <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Settings</a> --}}
      <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Sign Out</a>
    </div>
  </div>
  @endauth
</div>
