<div
  class="hidden lg:hidden bg-cool-gray-700 mb-4"
  :class="{ 'block': mobileMenuVisible, 'hidden': !mobileMenuVisible }"
>
  {{-- Mobile Navigation Menu --}}
  <x-header.menu class="px-2 pt-2 pb-3" :mobile="true" />
  @if(Auth::check())
  {{-- Mobile Options for Authenticated Users --}}
  <div class="pt-4 pb-3 border-t border-cool-gray-400">
    <div class="px-2">
      <a href="{{ route('backstage.posts.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Posts</a>
      <a href="{{ route('backstage.snippets.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Snippets</a>
      <a href="{{ route('backstage.tags.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Tags</a>
      <a href="{{ route('logout') }}" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Sign Out</a>
    </div>
  </div>
  @else
  <div class="pt-4 pb-3 border-t border-cool-gray-400">
    <div class="px-2">
      <a
        class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
        type="text/xml"
        href="{{ route('feed') }}"
      >
      <span class="inline-flex items-center">
        RSS Feed
        @svg('heroicon-s-rss', ['class' => 'w-4 h-4 ml-1'])
      </span>
      </a>
    </div>
  </div>
  @endif
</div>
