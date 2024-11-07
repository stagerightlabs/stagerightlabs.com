<div {{ $attributes->merge(['class' => 'bg-zinc-800 rounded text-zinc-300 border-t-2 border-red-900 overflow-hidden shadow sm:rounded-lg']) }}>
  @isset($heading)
    <div class="px-4 py-5 border-b border-zinc-700 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-zinc-400">
        {{ $heading }}
      </h3>
    </div>
  @endisset

  <div class="px-4 py-5 sm:p-6">
    {{ $slot }}
  </div>
</div>
