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
      &copy; {{ date('Y') }} Stage Right Labs
    </footer>
  </div>
</x-base-layout>
