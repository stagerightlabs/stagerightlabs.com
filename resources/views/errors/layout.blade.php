<x-layouts.base>
 <div class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
        <div class="px-4 text-5xl text-cool-gray-500 border-r border-cool-gray-600 tracking-wider">@yield('code')</div>

        <div class="ml-4 text-2xl text-cool-gray-500 uppercase tracking-wider">
          @yield('message')
        </div>
      </div>
    </div>
  </div>
</x-layouts.base>
