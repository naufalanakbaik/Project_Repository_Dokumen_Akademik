@if ($paginator->hasPages())

    <nav class="flex items-center justify-center">

        <div
            class="inline-flex items-center gap-2 rounded-2xl border border-gray-200 bg-white p-2 shadow-sm">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())

                <span
                    class="w-11 h-11 rounded-xl flex items-center justify-center text-gray-300 cursor-not-allowed">

                    <span class="material-icons-outlined text-[20px]">
                        chevron_left
                    </span>

                </span>

            @else

                <a href="{{ $paginator->previousPageUrl() }}"
                    class="w-11 h-11 rounded-xl flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">

                    <span class="material-icons-outlined text-[20px]">
                        chevron_left
                    </span>

                </a>

            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)

                @if (is_string($element))

                    <span class="px-2 text-gray-400">
                        {{ $element }}
                    </span>

                @endif

                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span
                                class="w-11 h-11 rounded-xl bg-blue-600 text-white text-sm font-semibold flex items-center justify-center shadow-sm">

                                {{ $page }}
                            </span>
                        @else

                            <a href="{{ $url }}"
                                class="w-11 h-11 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 flex items-center justify-center transition">

                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())

                <a href="{{ $paginator->nextPageUrl() }}"
                    class="w-11 h-11 rounded-xl flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">

                    <span class="material-icons-outlined text-[20px]">
                        chevron_right
                    </span>

                </a>

            @else

                <span
                    class="w-11 h-11 rounded-xl flex items-center justify-center text-gray-300 cursor-not-allowed">

                    <span class="material-icons-outlined text-[20px]">
                        chevron_right
                    </span>

                </span>

            @endif

        </div>

    </nav>

@endif