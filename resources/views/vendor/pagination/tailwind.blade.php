@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="flex items-center justify-center pagination">
        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-default rounded-l-md leading-5"
                            aria-hidden="true">
                            ←
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-blue-500 border border-gray-300 rounded-l-md leading-5 hover:bg-blue-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition ease-in-out duration-150"
                        aria-label="{{ __('pagination.previous') }}">
                        ←
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-600 border border-gray-300 cursor-default leading-5">{{ $page }}</span>
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition ease-in-out duration-150"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-white bg-blue-500 border border-gray-300 rounded-r-md leading-5 hover:bg-blue-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 transition ease-in-out duration-150"
                        aria-label="{{ __('pagination.next') }}">
                        →
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span
                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-default rounded-r-md leading-5"
                            aria-hidden="true">
                            →
                        </span>
                    </span>
                @endif
            </span>
        </div>
    </nav>
@endif
