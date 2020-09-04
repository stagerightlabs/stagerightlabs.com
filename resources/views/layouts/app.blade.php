@extends('layouts.base')

@section('body')
  <x-header class="mb-4" />
  <div class="container mx-auto p-4">
    @yield('content')
  </div>
@endsection
