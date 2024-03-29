<x-card {{ $attributes->merge(['class' => 'mb-4 px-4 author'])}}>
  <div class="grid grid-cols-1 md:grid-cols-9 gap-4">
    <div class="col-span-1 md:col-span-3">
      <img src="{{ url(asset('img/avatar.jpg')) }}" title="Avatar for Ryan Durham" class="rounded-full w-64 mx-auto p-8" />
    </div>
    <div class="col-span-1 md:col-span-6 flex justify-center flex-col">
      <h1 class="text-3xl mb-4">About the Author</h1>
      <p class="text-lg mb-4">
        Ryan C. Durham is a software developer who lives in southern Washington with his wife and daughter. His areas of interest include PHP, Laravel, Rust and PostgreSQL, as well as organizational efficiency and communications strategies.
      </p>
      <p class="text-lg">
        You can find him on <a href="https://github.com/stagerightlabs/" target="_blank" >GitHub</a>
        and <a href="https://www.linkedin.com/in/rydurham/" target="_blank">LinkedIn</a>.
      </p>
    </div>
  </div>
</x-card>
