@if ($paginator->hasPages())

    <nav class="flex items-center justify-center">

        <div
            class="inline-flex items-center gap-1.5
            rounded-2xl border border-gray-200
            bg-white px-2 py-2 shadow-sm">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())

                <span
                    class="w-10 h-10 rounded-xl
                    flex items-center justify-center
                    text-gray-300 cursor-not-allowed">

                    <span class="material-icons-outlined text-[18px]">
                        chevron_left
                    </span>

                </span>

            @else

                <a href="{{ $paginator->previousPageUrl() }}"
                    class="w-10 h-10 rounded-xl
                    flex items-center justify-center
                    text-gray-500 transition-all duration-200
                    hover:bg-amber-50 hover:text-amber-700">

                    <span class="material-icons-outlined text-[18px]">
                        chevron_left
                    </span>

                </a>

            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)

                {{-- Separator --}}
                @if (is_string($element))

                    <span class="px-1 text-sm text-gray-300">
                        {{ $element }}
                    </span>

                @endif

                {{-- Page Number --}}
                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span
                                class="w-10 h-10 rounded-xl
                                bg-amber-100 border border-amber-200
                                text-amber-700 text-sm font-semibold
                                flex items-center justify-center">

                                {{ $page }}

                            </span>

                        @else

                            <a href="{{ $url }}"
                                class="w-10 h-10 rounded-xl
                                text-sm font-medium text-gray-600
                                flex items-center justify-center
                                transition-all duration-200
                                hover:bg-gray-50 hover:text-gray-900">

                                {{ $page }}

                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())

                <a href="{{ $paginator->nextPageUrl() }}"
                    class="w-10 h-10 rounded-xl
                    flex items-center justify-center
                    text-gray-500 transition-all duration-200
                    hover:bg-amber-50 hover:text-amber-700">

                    <span class="material-icons-outlined text-[18px]">
                        chevron_right
                    </span>

                </a>

            @else

                <span
                    class="w-10 h-10 rounded-xl
                    flex items-center justify-center
                    text-gray-300 cursor-not-allowed">

                    <span class="material-icons-outlined text-[18px]">
                        chevron_right
                    </span>

                </span>

            @endif

        </div>

    </nav>

@endif