@extends('layouts.base')

@section('body')
  <x-header class="mb-4" />
  <div class="container mx-auto p-4">

    @if(session()->has('alerts'))
      <div class="mx-auto mb-4 -mt-4">
        <x-alert.tray :messages="session()->get('alerts', [])" :session="true" />
      </div>
    @endif

    @yield('content')

    <footer class="text-center w-full text-cool-gray-500 mb-4 mt-8">
      &copy; {{ date('Y') }} Stage Right Labs
    </footer>
  </div>
@endsection
