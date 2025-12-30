{{--
    SEO用Breadcrumbsコンポーネント（リニューアル版）
    使用例: @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    
    $breadcrumbs = [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => '名言・格言', 'url' => route('largecategories.index')],
        ['name' => '現在のページ']  // url無しで現在のページ
    ];
--}}

@if(isset($breadcrumbs) && count($breadcrumbs) > 0)
<nav aria-label="パンくずリスト" class="mb-6">
    <ol class="flex flex-wrap items-center gap-1 text-sm" itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach($breadcrumbs as $index => $crumb)
            <li class="flex items-center" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                @if(isset($crumb['url']))
                    <a href="{{ $crumb['url'] }}" itemprop="item" class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all">
                        @if($index === 0)
                            {{-- ホームアイコン --}}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        @endif
                        <span itemprop="name">{{ $crumb['name'] }}</span>
                    </a>
                @else
                    <span itemprop="name" class="px-2 py-1 text-gray-800 font-medium" aria-current="page">
                        {{ Str::limit($crumb['name'], 30) }}
                    </span>
                @endif
                <meta itemprop="position" content="{{ $index + 1 }}" />
            </li>
            @if(!$loop->last)
                <li aria-hidden="true" class="text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</nav>

{{-- 構造化データ（JSON-LD形式） --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        @foreach($breadcrumbs as $index => $crumb)
        {
            "@type": "ListItem",
            "position": {{ $index + 1 }},
            "name": "{{ $crumb['name'] }}"
            @if(isset($crumb['url']))
            ,"item": "{{ $crumb['url'] }}"
            @endif
        }@if(!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endif
