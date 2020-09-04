<div class="hidden lg:block lg:ml-4">
  <div class="flex items-center">
    <!-- Profile dropdown -->
    <div class="ml-4 relative flex-shrink-0">
      <div>
        <button
          class="flex text-sm rounded-full text-white focus:outline-none focus:shadow-solid transition duration-150 ease-in-out"
          id="user-menu"
          aria-label="User menu"
          aria-haspopup="true"
          @click="profileMenuVisible = !profileMenuVisible"
        >
          <x-heroicon-s-user-circle class="h-8 w-8 text-cool-gray-300" />
        </button>
      </div>
      {{-- Drop Down Profile Panel --}}
      <div
        x-show="profileMenuVisible"
        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        @click.away="profileMenuVisible = false"
        style="display: none"
      >
        <div class="py-1 rounded-md bg-cool-gray-700 shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
          <a href="#" class="block px-4 py-2 text-sm leading-5 text-cool-gray-300 hover:bg-cool-gray-400 hover:text-cool-gray-700 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Posts</a>
          <a href="{{ route('backstage.snippets.index') }}" class="block px-4 py-2 text-sm leading-5 text-cool-gray-300 hover:bg-cool-gray-400 hover:text-cool-gray-700 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Snippets</a>
          <a href="{{ route('backstage.tags.index') }}" class="block px-4 py-2 text-sm leading-5 text-cool-gray-300 hover:bg-cool-gray-400 hover:text-cool-gray-700 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Tags</a>
          <div class="border-t border-cool-gray-500">
            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm leading-5 text-cool-gray-300 hover:bg-cool-gray-400 hover:text-cool-gray-700 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Sign out</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
