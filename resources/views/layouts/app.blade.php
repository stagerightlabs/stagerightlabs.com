<x-base-layout>
  <x-header class="mb-6 lg:mb-12" />
  <div class="container mx-auto">

    @if(session()->has('alerts'))
      <div class="mx-auto mb-4 -mt-4">
        <x-alert.tray :messages="session()->get('alerts', [])" :session="true" />
      </div>
    @endif

    @yield('content')

    @isset($slot)
      {{ $slot }}
    @endisset

    <footer class="text-center w-full text-cool-gray-500 mb-4 mt-8">
      <p class="mb-2">&copy;{{ date('Y') }} Stage Right Labs</p>
      <p>
        <a type="text/xml" href="{{ route('feed') }}" class="flex items-center justify-center" >
          RSS Feed @svg('heroicon-s-rss', ['class' => 'w-4 h-4 ml-1'])
        </a>
      </p>
    </footer>
  </div>
</x-base-layout>
