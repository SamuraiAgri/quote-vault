{{--
    お気に入りボタンコンポーネント（ローカルストレージ版）
    使用例: @include('components.favorite-button', ['id' => $quote->id, 'type' => 'quote'])
    
    対応type: 'quote', 'proverb', 'poem'
--}}

@php
    $type = $type ?? 'quote';
    $storageKey = 'favorites_' . $type . 's';
@endphp

<button 
    id="favorite-btn-{{ $type }}-{{ $id }}"
    onclick="toggleFavorite('{{ $type }}', {{ $id }})"
    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border-2 transition-all duration-300 favorite-btn"
    data-type="{{ $type }}"
    data-id="{{ $id }}"
    aria-label="お気に入りに追加"
>
    <svg class="w-5 h-5 favorite-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
    </svg>
    <span class="favorite-text text-sm font-medium">お気に入り</span>
</button>

<style>
.favorite-btn.is-favorite {
    background-color: #FEE2E2;
    border-color: #EF4444;
    color: #DC2626;
}
.favorite-btn.is-favorite .favorite-icon {
    fill: #EF4444;
    stroke: #EF4444;
}
.favorite-btn:not(.is-favorite) {
    background-color: white;
    border-color: #D1D5DB;
    color: #6B7280;
}
.favorite-btn:not(.is-favorite):hover {
    border-color: #EF4444;
    color: #EF4444;
}
</style>

<script>
// お気に入り機能（ローカルストレージ使用）
function getFavorites(type) {
    const key = 'favorites_' + type + 's';
    const stored = localStorage.getItem(key);
    return stored ? JSON.parse(stored) : [];
}

function saveFavorites(type, favorites) {
    const key = 'favorites_' + type + 's';
    localStorage.setItem(key, JSON.stringify(favorites));
}

function isFavorite(type, id) {
    const favorites = getFavorites(type);
    return favorites.includes(id);
}

function toggleFavorite(type, id) {
    const favorites = getFavorites(type);
    const index = favorites.indexOf(id);
    
    if (index === -1) {
        favorites.push(id);
    } else {
        favorites.splice(index, 1);
    }
    
    saveFavorites(type, favorites);
    updateFavoriteButton(type, id);
}

function updateFavoriteButton(type, id) {
    const btn = document.getElementById('favorite-btn-' + type + '-' + id);
    if (!btn) return;
    
    const isFav = isFavorite(type, id);
    const textEl = btn.querySelector('.favorite-text');
    
    if (isFav) {
        btn.classList.add('is-favorite');
        btn.setAttribute('aria-label', 'お気に入りから削除');
        if (textEl) textEl.textContent = 'お気に入り済み';
    } else {
        btn.classList.remove('is-favorite');
        btn.setAttribute('aria-label', 'お気に入りに追加');
        if (textEl) textEl.textContent = 'お気に入り';
    }
}

// ページ読み込み時に状態を復元
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.favorite-btn').forEach(function(btn) {
        const type = btn.dataset.type;
        const id = parseInt(btn.dataset.id);
        updateFavoriteButton(type, id);
    });
});
</script>
