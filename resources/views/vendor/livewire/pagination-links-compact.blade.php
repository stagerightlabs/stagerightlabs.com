@if($paginator->hasPages())
  <span class="relative z-0 inline-flex shadow-sm">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-cool-gray-600 bg-cool-gray-700 border border-cool-gray-700 cursor-default rounded-l-md leading-5" aria-hidden="true">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </span>
      </span>
    @else
      <button wire:click="previousPage" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-cool-gray-400 bg-cool-gray-700 border border-cool-gray-700 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-cool-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
      </button>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <span aria-disabled="true">
          <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-400 bg-cool-gray-700 border border-cool-gray-700 cursor-default leading-5">{{ $element }}</span>
        </span>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <span aria-current="page">
              <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-cool-gray-800 bg-cool-gray-600 border border-cool-gray-700 cursor-default leading-5">{{ $page }}</span>
            </span>
          @else
            <button wire:click="gotoPage({{ $page }})" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-400 bg-cool-gray-700 border border-cool-gray-700 leading-5 hover:text-cool-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('pagination.goto_page', ['page' => $page]) }}">
              {{ $page }}
            </button>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <button wire:click="nextPage" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-cool-gray-400 bg-cool-gray-700 border border-cool-gray-700 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-cool-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
      </button>
    @else
      <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
        <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-cool-gray-600 bg-cool-gray-700 border border-cool-gray-700 cursor-default rounded-r-md leading-5" aria-hidden="true">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </span>
      </span>
    @endif
  </span>
@endif