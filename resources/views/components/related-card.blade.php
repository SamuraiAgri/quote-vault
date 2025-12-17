{{--
    関連コンテンツカードコンポーネント
    使用例: @include('components.related-card', ['item' => $quote, 'type' => 'quote'])
    
    対応type: 'quote', 'proverb', 'poem'
--}}

@php
    $type = $type ?? 'quote';
@endphp

<div class="bg-white shadow rounded-lg p-4 hover:shadow-lg transition">
    @switch($type)
        @case('quote')
            <blockquote class="text-gray-800 italic mb-3 line-clamp-3">
                "{{ Str::limit($item->quote_text, 80) }}"
            </blockquote>
            <p class="text-sm text-gray-600 mb-2">
                - {{ $item->author->name ?? '不明' }}
            </p>
            <a href="{{ route('quotes.show', $item->id) }}" 
               class="inline-block text-blue-600 hover:text-blue-800 text-sm font-medium">
                詳細を見る →
            </a>
            @break
            
        @case('proverb')
            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs rounded mb-2">
                {{ $item->type }}
            </span>
            <h3 class="font-bold text-gray-800 mb-2">{{ $item->word }}</h3>
            <p class="text-sm text-gray-600 mb-2">{{ $item->reading }}</p>
            <p class="text-sm text-gray-700 line-clamp-2">{{ Str::limit($item->meaning, 60) }}</p>
            <a href="{{ route('proverbs.show', $item->id) }}" 
               class="inline-block text-green-600 hover:text-green-800 text-sm font-medium mt-2">
                詳細を見る →
            </a>
            @break
            
        @case('poem')
            <div class="text-purple-600 font-bold text-sm mb-2">第{{ $item->number }}番</div>
            <p class="text-gray-800 mb-1">{{ $item->upper_phrase }}</p>
            <p class="text-gray-800 mb-2">{{ $item->lower_phrase }}</p>
            <p class="text-sm text-gray-600">
                歌人: {{ $item->poet->name ?? '不明' }}
            </p>
            <a href="{{ route('hyakuninisshu.show', $item->id) }}" 
               class="inline-block text-purple-600 hover:text-purple-800 text-sm font-medium mt-2">
                詳細を見る →
            </a>
            @break
    @endswitch
</div>
