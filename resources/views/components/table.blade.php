<div class="flex flex-col mb-8">
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-cool-gray-800">
      <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-cool-gray-800']) }}>
        @isset($th)
        <thead>
          <tr>
            {{ $th }}
          </tr>
        </thead>
        @endisset
        <tbody class="bg-cool-gray-700 divide-y divide-cool-gray-800">
          {{ $slot }}
        </tbody>
      </table>
      @isset($footer)
        {{ $footer }}
      @endisset
    </div>
  </div>
</div>
