{{--
    検索フォームコンポーネント
    使用例: @include('components.search-form', ['action' => route('search.index'), 'placeholder' => '名言を検索...'])
--}}

@php
    $action = $action ?? route('search.index');
    $placeholder = $placeholder ?? 'キーワードを入力...';
    $keyword = $keyword ?? request('q', '');
    $inputName = $inputName ?? 'q';
@endphp

<form action="{{ $action }}" method="GET" class="w-full" role="search">
    <div class="relative">
        <input type="search" 
               name="{{ $inputName }}" 
               value="{{ $keyword }}"
               placeholder="{{ $placeholder }}"
               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
               aria-label="検索キーワード">
        <button type="submit" 
                class="absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-gray-500 hover:text-blue-600 transition"
                aria-label="検索">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </button>
    </div>
    
    @if(isset($filters))
        <div class="mt-3 flex flex-wrap gap-2">
            {{ $filters }}
        </div>
    @endif
</form>
