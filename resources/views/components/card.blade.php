<div {{ $attributes->merge(['class' => 'bg-cool-gray-800 rounded text-cool-gray-300 border-t-2 border-red-900 overflow-hidden shadow sm:rounded-lg']) }}>
  <div class="px-4 py-5 sm:p-6">
    {{ $slot }}
  </div>
</div>
