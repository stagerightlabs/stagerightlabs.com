<div {{ $attributes->merge(['class' => 'lg:flex lg:items-center lg:justify-between mb-8']) }}>
  <div class="flex-1 min-w-0">
    <h2 class="text-2xl font-bold leading-7 tracking-wide text-cool-gray-300 sm:text-3xl sm:leading-9 sm:truncate">
      {{ $slot }}
    </h2>
    @isset($meta)
    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap">
      {{ $meta }}
    </div>
    @endisset
  </div>
  @isset($options)
  <div class="mt-5 flex lg:mt-0 lg:ml-4">
    {{ $options }}
  </div>
  @endisset
</div>
