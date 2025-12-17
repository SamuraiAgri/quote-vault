{{--
    SEO用Breadcrumbsコンポーネント
    使用例: @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    
    $breadcrumbs = [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => '名言・格言', 'url' => route('largecategories.index')],
        ['name' => '現在のページ']  // url無しで現在のページ
    ];
--}}

@if(isset($breadcrumbs) && count($breadcrumbs) > 0)
<nav aria-label="パンくずリスト" class="mb-4">
    <ol class="flex flex-wrap items-center text-sm text-gray-600" itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach($breadcrumbs as $index => $crumb)
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                @if(isset($crumb['url']))
                    <a href="{{ $crumb['url'] }}" itemprop="item" class="hover:text-blue-600 transition">
                        <span itemprop="name">{{ $crumb['name'] }}</span>
                    </a>
                @else
                    <span itemprop="name" class="text-gray-800 font-medium" aria-current="page">{{ $crumb['name'] }}</span>
                @endif
                <meta itemprop="position" content="{{ $index + 1 }}" />
            </li>
            @if(!$loop->last)
                <li aria-hidden="true" class="mx-2 text-gray-400">
                    &gt;
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
