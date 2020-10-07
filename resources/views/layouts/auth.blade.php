<x-layouts.base>
  <div class="flex flex-col justify-center min-h-screen py-12 sm:px-6 lg:px-8">
    <div>
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
          <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center leading-9">
          @yield('heading')
        </h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        {{ $slot }}
      </div>
    </div>
  </div>
</x-layouts.base>
