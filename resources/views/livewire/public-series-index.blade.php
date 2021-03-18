@section('title', 'Series')

@section('meta')
<x-meta.general />
@endsection

<div>
  <x-page-header>
    Series
  </x-page-header>
  <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
    <div class="col-span-1 md:col-span-12">
      @forelse ($series as $s)
        <a href="{{ route('series.show', $s->slug) }}">
          <x-card class="mb-4">
            <h2 class="text-2xl mb-4">{{ $s->name }}</h2>
            <p class="text-cool-gray-400 text-xl mb-6">
              {{ $s->description }}
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2">
              <p class="grid-cols-1">
              </p>
              <p class="grid-cols-1 inline-flex items-end justify-end text-red-700 text-lg">
                Read
                @svg('heroicon-s-chevron-double-right', ['class' => 'h-4 w-4 mb-1 ml-1'])
              </p>
            </div>
          </x-card>
        </a>
      @empty
        <x-card>
          <p>There are no series available at the moment.</p>
        </x-card>
      @endforelse

      <div class="w-full mt-8">
        {{ $series->links('pagination-links-compact') }}
      </div>

    </div>
  </div>
</div>
