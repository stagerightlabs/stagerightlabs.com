@if($paginator->hasPages())
  <nav role="navigation" aria-label="Pagination Navigation"
       class="flex items-center justify-between px-4 py-3 border-t border-cool-gray-600 sm:px-6">
    <div class="flex justify-between flex-1 sm:hidden">
      @if($paginator->onFirstPage())
        <span
              class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
          {!! __('pagination.previous') !!}
        </span>
      @else
        <button wire:click="previousPage"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
          {!! __('pagination.previous') !!}
        </button>
      @endif

      @if($paginator->hasMorePages())
        <button wire:click="nextPage"
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
          {!! __('pagination.next') !!}
        </button>
      @else
        <span
              class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
          {!! __('pagination.next') !!}
        </span>
      @endif
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-500 leading-5">
          <span>Showing</span>
          <span class="font-medium">{{ $paginator->firstItem() }}</span>
          <span>to</span>
          <span class="font-medium">{{ $paginator->lastItem() }}</span>
          <span>of</span>
          <span class="font-medium">{{ $paginator->total() }}</span>
          <span>results</span>
        </p>
      </div>

      <div>
        @include('pagination-links-compact')
      </div>
    </div>
  </nav>
@endif
