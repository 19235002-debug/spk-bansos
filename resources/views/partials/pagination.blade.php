@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between sm:justify-end gap-2">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-400 text-xs font-semibold cursor-not-allowed select-none opacity-60">
                <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 text-xs font-semibold shadow-2xs transition">
                <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Prev
            </a>
        @endif

        <!-- Pagination Elements -->
        <div class="hidden sm:flex items-center gap-1">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-2 py-1 text-slate-400 text-xs font-bold">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-indigo-600 text-white text-xs font-bold shadow-xs border border-indigo-600">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 text-xs font-semibold transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 text-xs font-semibold shadow-2xs transition">
                Next
                <svg class="w-3.5 h-3.5 ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        @else
            <span class="inline-flex items-center px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-400 text-xs font-semibold cursor-not-allowed select-none opacity-60">
                Next
                <svg class="w-3.5 h-3.5 ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
        @endif
    </nav>
@endif
