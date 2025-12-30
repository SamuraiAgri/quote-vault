require('./bootstrap');
import { createApp } from 'vue';

// Vueコンポーネントのインポート
import RandomQuote from './components/RandomQuote.vue';
import DailyQuote from './components/DailyQuote.vue';
import QuickSearch from './components/QuickSearch.vue';
import ContentNavigation from './components/ContentNavigation.vue';
import QuoteCard from './components/QuoteCard.vue';
import MobileNavigation from './components/MobileNavigation.vue';

// Vueアプリケーションの作成
const app = createApp({});

// グローバルコンポーネントの登録
app.component('random-quote', RandomQuote);
app.component('daily-quote', DailyQuote);
app.component('quick-search', QuickSearch);
app.component('content-navigation', ContentNavigation);
app.component('quote-card', QuoteCard);
app.component('mobile-navigation', MobileNavigation);

// アプリケーションをマウント
if (document.getElementById('app')) {
    app.mount('#app');
}

// モバイルメニュー用のシンプルなJS（Vue外での初期化）
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            const isExpanded = !mobileMenu.classList.contains('hidden');
            mobileMenuBtn.setAttribute('aria-expanded', isExpanded);
        });
    }
});