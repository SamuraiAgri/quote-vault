{{-- resources/views/layout.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- タイトル --}}
    <title>@yield('title', '偉人の名言・格言・ことわざ・百人一首サイト')</title>
    
    {{-- メタディスクリプション --}}
    <meta name="description" content="@yield('meta_description', '偉人の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を簡単に検索できるサイトです。カテゴリ別、著者別、キーワード検索で、あなたにぴったりの言葉が見つかります。')">
    
    {{-- キーワード --}}
    <meta name="keywords" content="@yield('meta_keywords', '名言,格言,ことわざ,四字熟語,慣用句,百人一首,偉人,著者,検索,人気,ランキング')">
    
    {{-- 正規URL --}}
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- OGPタグ（Facebook、Twitter用） --}}
    <meta property="og:site_name" content="名言・格言・ことわざ・百人一首サイト">
    <meta property="og:title" content="@yield('title', '偉人の名言・格言・ことわざ・百人一首サイト')">
    <meta property="og:description" content="@yield('meta_description', '偉人の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を簡単に検索できるサイトです。')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('img/ijin.png'))">
    <meta property="og:locale" content="ja_JP">
    
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', '偉人の名言・格言・ことわざ・百人一首サイト')">
    <meta name="twitter:description" content="@yield('meta_description', '偉人の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を簡単に検索できるサイトです。')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('img/ijin.png'))">
    
    {{-- ロボット制御 --}}
    <meta name="robots" content="@yield('robots', 'index, follow')">
    
    {{-- Google Site Verification（必要に応じて追加） --}}
    {{-- <meta name="google-site-verification" content="your-verification-code"> --}}
    
    {{-- 構造化データ --}}
    @hasSection('structured_data')
        @yield('structured_data')
    @else
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "名言・格言・ことわざ・百人一首サイト",
            "url": "{{ url('/') }}",
            "description": "偉人の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を検索できるサイト",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ route('search.index') }}?query={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
        </script>
    @endif
    
    {{-- プリロード：重要なリソースを優先的に読み込む --}}
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style">
    
    {{-- DNSプリフェッチ：外部リソースの接続を事前に確立 --}}
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    
    {{-- テーマカラー --}}
    <meta name="theme-color" content="#2563eb">
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    {{-- Google AdSense --}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8001546494492220"
     crossorigin="anonymous"></script>
    
    {{-- Google Analytics（本番環境で有効化） --}}
    {{-- 
    @if(app()->environment('production'))
    <script async src="https://www.googletagmanager.com/gtag/js?id=YOUR-GA-ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'YOUR-GA-ID');
    </script>
    @endif
    --}}
</head>
<body class="bg-gray-100 text-gray-800">

<header class="bg-blue-600 text-white shadow-md" role="banner">
    <nav class="container mx-auto px-4 py-4" role="navigation" aria-label="メインナビゲーション">
        <div class="flex justify-between items-center">
            <h1 class="font-bold {{ $agent->isMobile() ? 'text-sm' : 'text-lg' }}"> 
                <a href="{{ route('home') }}" class="hover:underline" aria-label="ホームページへ">名言・格言・ことわざ・百人一首サイト</a>
            </h1>
            
            @if($agent->isMobile())
                <!-- モバイルメニューボタン -->
                <button id="mobile-menu-btn" class="p-2" aria-label="メニューを開く" aria-expanded="false" aria-controls="mobile-menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            @else
                <!-- PC・タブレットナビゲーション -->
                <div class="flex space-x-8">
                    <a href="{{ route('largecategories.index') }}" class="hover:underline py-2 text-base">名言・格言</a>
                    <a href="{{ route('proverbs.index') }}" class="hover:underline py-2 text-base">ことわざ・四字熟語</a>
                    <a href="{{ route('hyakuninisshu.index') }}" class="hover:underline py-2 text-base">百人一首</a>
                </div>
            @endif
        </div>
        
        @if($agent->isMobile())
            <!-- モバイルナビゲーション -->
            <div id="mobile-menu" class="hidden mt-4 border-t border-blue-500 pt-4">
                <div class="space-y-3">
                    <a href="{{ route('largecategories.index') }}" class="block hover:bg-blue-700 py-2 px-4 rounded text-sm">名言・格言</a>
                    <a href="{{ route('proverbs.index') }}" class="block hover:bg-blue-700 py-2 px-4 rounded text-sm">ことわざ・四字熟語</a>
                    <a href="{{ route('hyakuninisshu.index') }}" class="block hover:bg-blue-700 py-2 px-4 rounded text-sm">百人一首</a>
                </div>
            </div>
        @endif
    </nav>
</header>

    <main id="main-content" class="container mx-auto px-4 py-6" role="main">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-8" role="contentinfo">
        <div class="container mx-auto px-4">
            <!-- サイトマップ -->
            @if($agent->isMobile())
                <!-- モバイル版フッター -->
                <div class="space-y-6 mb-8">
                    <!-- 名言・格言 -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-blue-300">名言・格言</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('largecategories.index') }}" class="block hover:text-blue-300 transition">大カテゴリ一覧</a>
                            <a href="{{ route('authors.index') }}" class="block hover:text-blue-300 transition">著者一覧</a>
                            <a href="{{ route('quotes.popular') }}" class="block hover:text-blue-300 transition">人気の名言</a>
                        </div>
                    </div>

                    <!-- ことわざ・四字熟語 -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-green-300">ことわざ・四字熟語</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('proverb-categories.index') }}" class="block hover:text-green-300 transition">カテゴリ一覧</a>
                            <a href="{{ route('proverbs.by-type', 'ことわざ') }}" class="block hover:text-green-300 transition">ことわざ</a>
                            <a href="{{ route('proverbs.by-type', '四字熟語') }}" class="block hover:text-green-300 transition">四字熟語</a>
                            <a href="{{ route('proverbs.by-type', '慣用句') }}" class="block hover:text-green-300 transition">慣用句</a>
                            <a href="{{ route('proverbs.popular') }}" class="block hover:text-green-300 transition">人気ランキング</a>
                        </div>
                    </div>

                    <!-- 百人一首 -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-purple-300">百人一首</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('poets.index') }}" class="block hover:text-purple-300 transition">歌人一覧</a>
                            <a href="{{ route('hyakuninisshu.by-season', '春') }}" class="block hover:text-purple-300 transition">季節別の歌</a>
                            <a href="{{ route('hyakuninisshu.by-theme', '恋') }}" class="block hover:text-purple-300 transition">恋の歌</a>
                            <a href="{{ route('hyakuninisshu.popular') }}" class="block hover:text-purple-300 transition">人気ランキング</a>
                        </div>
                    </div>

                    <!-- その他 -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-orange-300">その他</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('home') }}" class="block hover:text-orange-300 transition">ホーム</a>
                            <a href="{{ route('search.index') }}" class="block hover:text-orange-300 transition">全体検索</a>
                            <a href="{{ route('proverbs.search') }}" class="block hover:text-orange-300 transition">ことわざ検索</a>
                            <a href="{{ route('hyakuninisshu.search') }}" class="block hover:text-orange-300 transition">百人一首検索</a>
                        </div>
                    </div>

                    <!-- ポリシー -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gray-300">ポリシー</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('privacy') }}" class="block hover:text-gray-300 transition">プライバシーポリシー</a>
                            <a href="{{ route('terms') }}" class="block hover:text-gray-300 transition">利用規約</a>
                            <a href="{{ route('contact') }}" class="block hover:text-gray-300 transition">お問い合わせ</a>
                        </div>
                    </div>
                </div>
            @else
                <!-- PC版フッター -->
                <div class="grid grid-cols-4 gap-8 mb-8">
                    <!-- 名言・格言 -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-blue-300">名言・格言</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('largecategories.index') }}" class="block hover:text-blue-300 transition">大カテゴリ一覧</a>
                            <a href="{{ route('authors.index') }}" class="block hover:text-blue-300 transition">著者一覧</a>
                            <a href="{{ route('quotes.popular') }}" class="block hover:text-blue-300 transition">人気の名言</a>
                        </div>
                    </div>

                    <!-- ことわざ・四字熟語 -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-green-300">ことわざ・四字熟語</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('proverb-categories.index') }}" class="block hover:text-green-300 transition">カテゴリ一覧</a>
                            <a href="{{ route('proverbs.by-type', 'ことわざ') }}" class="block hover:text-green-300 transition">ことわざ</a>
                            <a href="{{ route('proverbs.by-type', '四字熟語') }}" class="block hover:text-green-300 transition">四字熟語</a>
                            <a href="{{ route('proverbs.by-type', '慣用句') }}" class="block hover:text-green-300 transition">慣用句</a>
                            <a href="{{ route('proverbs.popular') }}" class="block hover:text-green-300 transition">人気ランキング</a>
                            <a href="{{ route('proverbs.search') }}" class="block hover:text-green-300 transition">検索</a>
                        </div>
                    </div>

                    <!-- 百人一首 -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-purple-300">百人一首</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('poets.index') }}" class="block hover:text-purple-300 transition">歌人一覧</a>
                            <a href="{{ route('hyakuninisshu.by-season', '春') }}" class="block hover:text-purple-300 transition">春の歌</a>
                            <a href="{{ route('hyakuninisshu.by-season', '夏') }}" class="block hover:text-purple-300 transition">夏の歌</a>
                            <a href="{{ route('hyakuninisshu.by-season', '秋') }}" class="block hover:text-purple-300 transition">秋の歌</a>
                            <a href="{{ route('hyakuninisshu.by-season', '冬') }}" class="block hover:text-purple-300 transition">冬の歌</a>
                            <a href="{{ route('hyakuninisshu.by-theme', '恋') }}" class="block hover:text-purple-300 transition">恋の歌</a>
                            <a href="{{ route('hyakuninisshu.popular') }}" class="block hover:text-purple-300 transition">人気ランキング</a>
                            <a href="{{ route('hyakuninisshu.search') }}" class="block hover:text-purple-300 transition">検索</a>
                        </div>
                    </div>

                    <!-- その他 -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-orange-300">その他</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('home') }}" class="block hover:text-orange-300 transition">ホーム</a>
                            <a href="{{ route('search.index') }}" class="block hover:text-orange-300 transition">全体検索</a>
                        </div>
                    </div>

                    <!-- ポリシー -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-gray-300">ポリシー</h3>
                        <div class="space-y-2 text-sm">
                            <a href="{{ route('privacy') }}" class="block hover:text-gray-300 transition">プライバシーポリシー</a>
                            <a href="{{ route('terms') }}" class="block hover:text-gray-300 transition">利用規約</a>
                            <a href="{{ route('contact') }}" class="block hover:text-gray-300 transition">お問い合わせ</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- コピーライト -->
            <div class="border-t border-gray-600 pt-4 text-center text-sm">
                <p>&copy; 2024 偉人の名言・格言・ことわざ・百人一首サイト</p>
                <div class="mt-2 space-x-4">
                    <a href="{{ route('privacy') }}" class="hover:text-gray-300 transition">プライバシーポリシー</a>
                    <span>|</span>
                    <a href="{{ route('terms') }}" class="hover:text-gray-300 transition">利用規約</a>
                    <span>|</span>
                    <a href="{{ route('contact') }}" class="hover:text-gray-300 transition">お問い合わせ</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // モバイルメニューの切り替え（アクセシビリティ対応）
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            
            if (menuBtn && menu) {
                menuBtn.addEventListener('click', function() {
                    const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
                    
                    // メニューの表示/非表示を切り替え
                    menu.classList.toggle('hidden');
                    
                    // ARIAステートを更新
                    menuBtn.setAttribute('aria-expanded', !isExpanded);
                    menuBtn.setAttribute('aria-label', isExpanded ? 'メニューを開く' : 'メニューを閉じる');
                });
                
                // Escapeキーでメニューを閉じる
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                        menuBtn.setAttribute('aria-expanded', 'false');
                        menuBtn.setAttribute('aria-label', 'メニューを開く');
                        menuBtn.focus();
                    }
                });
            }
        });
    </script>
</body>
</html>