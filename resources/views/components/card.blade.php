<div {{ $attributes->merge(['class' => 'bg-cool-gray-800 rounded text-cool-gray-300 border-t-2 border-red-900 overflow-hidden shadow sm:rounded-lg']) }}>
  @isset($heading)
    <div class="px-4 py-5 border-b border-cool-gray-700 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-cool-gray-400">
        {{ $heading }}
      </h3>
    </div>
  @endisset

  <div class="px-4 py-5 sm:p-6">
    {{ $slot }}
  </div>
</div>
