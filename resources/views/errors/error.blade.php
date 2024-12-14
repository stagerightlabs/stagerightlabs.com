@extends('layout')

@section('title')
  @yield('code')
@endsection

@section('content')
<div class="xl:absolute h-96 xl:h-screen xl:inset-0 xl:w-2/3 flex flex-col justify-center items-center">
  <h1 class="text-8xl mb-4">@yield('code')</h1>
  <p class="text-4xl">@yield('message')</p>
</div>
@endsection
