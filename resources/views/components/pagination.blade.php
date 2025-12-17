{{--
    SEO対応ページネーションコンポーネント
    使用例: @include('components.pagination', ['paginator' => $results])
    
    特徴:
    - rel="prev/next" 対応
    - アクセシビリティ対応（ARIA）
    - クエリパラメータ保持
--}}

@if ($paginator->hasPages())
<nav role="navigation" aria-label="ページネーション" class="flex justify-center mt-8">
    <ul class="flex items-center gap-1">
        {{-- 前のページ --}}
        @if ($paginator->onFirstPage())
            <li>
                <span class="px-3 py-2 text-gray-400 cursor-not-allowed" aria-disabled="true">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" 
                   rel="prev"
                   class="px-3 py-2 text-blue-600 hover:bg-blue-100 rounded transition"
                   aria-label="前のページ">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            </li>
        @endif

        {{-- ページ番号 --}}
        @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
            @if ($page == $paginator->currentPage())
                <li>
                    <span class="px-4 py-2 bg-blue-600 text-white rounded font-medium" aria-current="page">
                        {{ $page }}
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $url }}" 
                       class="px-4 py-2 text-blue-600 hover:bg-blue-100 rounded transition">
                        {{ $page }}
                    </a>
                </li>
            @endif
        @endforeach

        {{-- 次のページ --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" 
                   rel="next"
                   class="px-3 py-2 text-blue-600 hover:bg-blue-100 rounded transition"
                   aria-label="次のページ">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </li>
        @else
            <li>
                <span class="px-3 py-2 text-gray-400 cursor-not-allowed" aria-disabled="true">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            </li>
        @endif
    </ul>
</nav>

{{-- ページ情報 --}}
<div class="text-center text-sm text-gray-600 mt-4">
    {{ $paginator->total() }}件中 
    {{ $paginator->firstItem() ?? 0 }}〜{{ $paginator->lastItem() ?? 0 }}件を表示
</div>
@endif
