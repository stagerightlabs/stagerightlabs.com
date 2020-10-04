@extends('layouts.app')

@section('title', 'Decks')


@section('content')
  <x-page-header>Presentation Decks</x-page-header>
  <x-card class="mb-8">
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <a href="{{ route('decks.show', ['laravel-101']) }}">
        <li class="col-span-1 flex flex-col text-center bg-cool-gray-700 hover:bg-cool-gray-600 rounded-lg shadow">
          <div class="flex-1 flex flex-col p-8">
            <svg class="w-32 h-32 fill-current mx-auto" viewBox="0 0 50 52" xmlns="http://www.w3.org/2000/svg">
              <title>Laravel Logo</title>
              <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill-rule="evenodd" />
            </svg>
            <h3 class="mt-6 text-cool-gray-300 text-sm leading-5 font-medium">Laravel 101</h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
              <dt class="sr-only">Description</dt>
              <dd class="text-cool-gray-400 text-sm leading-5">An introduction to Laravel</dd>
              <dt class="sr-only">Year</dt>
              <dd class="mt-3">
                <x-tag>2014</x-tag>
              </dd>
            </dl>
          </div>
        </li>
      </a>
      <a href="{{ route('decks.show', ['single-table-inheritance']) }}">
        <li class="col-span-1 flex flex-col text-center bg-cool-gray-700 hover:bg-cool-gray-600 rounded-lg shadow">
          <div class="flex-1 flex flex-col p-8">
            @svg('heroicon-s-database', ['class' => 'w-32 h-32 mx-auto'])
            <h3 class="mt-6 text-cool-gray-300 text-sm leading-5 font-medium">Single Table Inheritance</h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
              <dt class="sr-only">Description</dt>
              <dd class="text-cool-gray-400 text-sm leading-5">An introduction to STI with PHP</dd>
              <dt class="sr-only">Year</dt>
              <dd class="mt-3">
                <x-tag>2015</x-tag>
              </dd>
            </dl>
          </div>
        </li>
      </a>
      <a href="{{ route('decks.show', ['the-secret-power-of-renderless-vue-components']) }}">
        <li class="col-span-1 flex flex-col text-center bg-cool-gray-700 hover:bg-cool-gray-600 rounded-lg shadow">
          <div class="flex-1 flex flex-col p-8">
            <svg version="1.1" class="w-32 h-32 mx-auto" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 300" >
              <g>
                <polygon class="fill-current text-cool-gray-200" points="182.9,26.5 150,83.6 117.1,26.5 7.4,26.5 150,273.5 292.6,26.5 	"/>
                <polygon class="fill-current text-cool-gray-300" points="182.9,26.5 150,83.6 117.1,26.5 64.5,26.5 150,174.7 235.5,26.5 	"/>
              </g>
            </svg>
            <h3 class="mt-6 text-cool-gray-300 text-sm leading-5 font-medium">The Secret Power of Renderless Vue Components</h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
              <dt class="sr-only">Description</dt>
              <dd class="sr-only text-cool-gray-400 text-sm leading-5">Use render functions to create powerful vue component functionality. </dd>
              <dt class="sr-only">Year</dt>
              <dd class="mt-3">
                <x-tag>2019</x-tag>
              </dd>
            </dl>
          </div>
        </li>
      </a>
      <a href="{{ route('decks.show', ['tailwind-css']) }}">
        <li class="col-span-1 flex flex-col text-center bg-cool-gray-700 hover:bg-cool-gray-600 rounded-lg shadow">
          <div class="flex-1 flex flex-col p-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 mx-auto fill-current" viewBox="0 0 54 33">
              <g clip-path="url(#prefix__clip0)">
                <path fill-rule="evenodd" d="M27 0c-7.2 0-11.7 3.6-13.5 10.8 2.7-3.6 5.85-4.95 9.45-4.05 2.054.513 3.522 2.004 5.147 3.653C30.744 13.09 33.808 16.2 40.5 16.2c7.2 0 11.7-3.6 13.5-10.8-2.7 3.6-5.85 4.95-9.45 4.05-2.054-.513-3.522-2.004-5.147-3.653C36.756 3.11 33.692 0 27 0zM13.5 16.2C6.3 16.2 1.8 19.8 0 27c2.7-3.6 5.85-4.95 9.45-4.05 2.054.514 3.522 2.004 5.147 3.653C17.244 29.29 20.308 32.4 27 32.4c7.2 0 11.7-3.6 13.5-10.8-2.7 3.6-5.85 4.95-9.45 4.05-2.054-.513-3.522-2.004-5.147-3.653C23.256 19.31 20.192 16.2 13.5 16.2z" clip-rule="evenodd"/>
              </g>
            </svg>
            <h3 class="mt-6 text-cool-gray-300 text-sm leading-5 font-medium">Tailwind CSS</h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
              <dt class="sr-only">Description</dt>
              <dd class="text-cool-gray-400 text-sm leading-5">An introduction to Tailwind CSS</dd>
              <dt class="sr-only">Year</dt>
              <dd class="mt-3">
                <x-tag>2019</x-tag>
              </dd>
            </dl>
          </div>
        </li>
      </a>
      <a href="{{ route('decks.show', ['intro-to-docker']) }}">
        <li class="col-span-1 flex flex-col text-center bg-cool-gray-700 hover:bg-cool-gray-600 rounded-lg shadow">
          <div class="flex-1 flex flex-col p-8">
            <!-- https://iconscout.com/icon/docker-2752207 -->
            <svg xmlns="http://www.w3.org/2000/svg" aria-label="Docker" viewBox="0 0 500 500" class="w-32 h-32 mx-auto">
              <path class="text-cool-blue-300 stroke-current" stroke-width="38" d="M296 226h42m-92 0h42m-91 0h42m-91 0h41m-91 0h42m8-46h41m8 0h42m7 0h42m-42-46h42"/>
              <path class="text-cool-blue-300 fill-current" d="m472 228s-18-17-55-11c-4-29-35-46-35-46s-29 35-8 74c-6 3-16 7-31 7H68c-5 19-5 145 133 145 99 0 173-46 208-130 52 4 63-39 63-39"/>
            </svg>
            <h3 class="mt-6 text-cool-gray-300 text-sm leading-5 font-medium">A Gentle Introduction to Docker</h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
              <dt class="sr-only">Description</dt>
              <dd class="sr-only text-cool-gray-400 text-sm leading-5">Power up your development workflow with Docker </dd>
              <dt class="sr-only">Year</dt>
              <dd class="mt-3">
                <x-tag>2020</x-tag>
              </dd>
            </dl>
          </div>
        </li>
      </a>
    </ul>
  </x-card>
@endsection
