{{-- resources/views/layouts/app.blade.php --}}
{{-- 新しいモダンレイアウト --}}
<!DOCTYPE html>
<html lang="ja" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- タイトル --}}
    <title>@yield('title', '名言・格言・ことわざ・百人一首 | Quote Vault')</title>

    {{-- メタディスクリプション --}}
    <meta name="description"
        content="@yield('meta_description', '偉人の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を簡単に検索できるサイトです。人名別、テーマ別、キーワード検索であなたにぴったりの言葉が見つかります。')">

    {{-- キーワード --}}
    <meta name="keywords" content="@yield('meta_keywords', '名言,格言,ことわざ,四字熟語,慣用句,百人一首,偉人,著者,検索,人気,ランキング')">

    {{-- 正規URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- OGPタグ（Facebook、Twitter用） --}}
    <meta property="og:site_name" content="Quote Vault - 名言・格言・ことわざ・百人一首">
    <meta property="og:title" content="@yield('title', '名言・格言・ことわざ・百人一首 | Quote Vault')">
    <meta property="og:description"
        content="@yield('meta_description', '偉人の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を簡単に検索できるサイトです。')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('img/og-image.png'))">
    <meta property="og:locale" content="ja_JP">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', '名言・格言・ことわざ・百人一首 | Quote Vault')">
    <meta name="twitter:description"
        content="@yield('meta_description', '偉人の名言・格言、日本の伝統的なことわざ・四字熟語・慣用句、百人一首を簡単に検索できるサイトです。')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('img/og-image.png'))">

    {{-- ロボット制御 --}}
    <meta name="robots" content="@yield('robots', 'index, follow')">

    {{-- 構造化データ --}}
    @hasSection('structured_data')
        @yield('structured_data')
    @else
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebSite",
                "name": "Quote Vault - 名言・格言・ことわざ・百人一首",
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

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- プリコネクト --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Googleフォント（Noto Sans JP）--}}
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700&family=Noto+Serif+JP:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- DNSプリフェッチ --}}
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//pagead2.googlesyndication.com">

    {{-- テーマカラー --}}
    <meta name="theme-color" content="#1e40af">

    {{-- スタイルシート --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{-- Google Analytics --}}
    @if(config('app.env') === 'production')
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', 'G-XXXXXXXXXX');
        </script>
    @endif

    {{-- Google AdSense --}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8001546494492220"
        crossorigin="anonymous"></script>

    {{-- 追加のヘッドコンテンツ --}}
    @yield('head')
</head>

<body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen text-gray-800">
    <div id="app" class="flex flex-col min-h-screen">
        {{-- ヘッダー --}}
        <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100 shadow-sm" role="banner">
            <nav class="container mx-auto px-4" role="navigation" aria-label="メインナビゲーション">
                {{-- PC/タブレット表示 --}}
                <div class="hidden md:flex items-center justify-between h-16">
                    {{-- ロゴ --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-600/20 group-hover:shadow-blue-600/40 transition-all">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <span
                            class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Quote Vault
                        </span>
                    </a>

                    {{-- メインメニュー --}}
                    <div class="flex items-center gap-1">
                        <a href="{{ route('largecategories.index') }}"
                            class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all font-medium">
                            名言・格言
                        </a>
                        <a href="{{ route('authors.index') }}"
                            class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all font-medium">
                            偉人一覧
                        </a>
                        <a href="{{ route('proverbs.index') }}"
                            class="px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition-all font-medium">
                            ことわざ
                        </a>
                        <a href="{{ route('hyakuninisshu.index') }}"
                            class="px-4 py-2 rounded-lg text-gray-600 hover:text-purple-600 hover:bg-purple-50 transition-all font-medium">
                            百人一首
                        </a>
                    </div>

                    {{-- 検索ボタン --}}
                    <a href="{{ route('search.index') }}"
                        class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="text-sm">検索</span>
                    </a>
                </div>

                {{-- モバイル表示 --}}
                <div class="md:hidden flex items-center justify-between h-14">
                    {{-- ロゴ --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <span class="font-bold text-gray-800">Quote Vault</span>
                    </a>

                    {{-- 検索 & メニュー --}}
                    <div class="flex items-center gap-2">
                        <a href="{{ route('search.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors"
                            aria-label="検索">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </a>
                        <mobile-navigation></mobile-navigation>
                    </div>
                </div>
            </nav>
        </header>

        {{-- メインコンテンツ --}}
        <main id="main-content" class="flex-1" role="main">
            <div class="container mx-auto px-4 py-6 md:py-8">
                @yield('content')
            </div>
        </main>

        {{-- フッター --}}
        <footer class="bg-gray-900 text-white" role="contentinfo">
            <div class="container mx-auto px-4">
                {{-- メインフッター --}}
                <div class="py-12 grid grid-cols-2 md:grid-cols-5 gap-8">
                    {{-- ブランド --}}
                    <div class="col-span-2 md:col-span-1">
                        <div class="flex items-center gap-2 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <span class="text-lg font-bold">Quote Vault</span>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            偉人の名言・格言、ことわざ・四字熟語、百人一首を探せるサイト
                        </p>
                    </div>

                    {{-- 名言・格言 --}}
                    <div>
                        <h3 class="font-bold text-blue-400 mb-4">名言・格言</h3>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="{{ route('largecategories.index') }}"
                                    class="hover:text-white transition-colors">テーマ一覧</a></li>
                            <li><a href="{{ route('authors.index') }}"
                                    class="hover:text-white transition-colors">偉人一覧</a></li>
                            <li><a href="{{ route('quotes.popular') }}"
                                    class="hover:text-white transition-colors">人気ランキング</a></li>
                            <li><a href="{{ route('random.quote') }}"
                                    class="hover:text-white transition-colors">ランダム名言</a></li>
                        </ul>
                    </div>

                    {{-- ことわざ --}}
                    <div>
                        <h3 class="font-bold text-green-400 mb-4">ことわざ</h3>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="{{ route('proverbs.index') }}"
                                    class="hover:text-white transition-colors">トップ</a></li>
                            <li><a href="{{ route('proverbs.by-type', 'ことわざ') }}"
                                    class="hover:text-white transition-colors">ことわざ</a></li>
                            <li><a href="{{ route('proverbs.by-type', '四字熟語') }}"
                                    class="hover:text-white transition-colors">四字熟語</a></li>
                            <li><a href="{{ route('proverbs.by-type', '慣用句') }}"
                                    class="hover:text-white transition-colors">慣用句</a></li>
                            <li><a href="{{ route('proverbs.popular') }}"
                                    class="hover:text-white transition-colors">人気ランキング</a></li>
                        </ul>
                    </div>

                    {{-- 百人一首 --}}
                    <div>
                        <h3 class="font-bold text-purple-400 mb-4">百人一首</h3>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="{{ route('hyakuninisshu.index') }}"
                                    class="hover:text-white transition-colors">一覧</a></li>
                            <li><a href="{{ route('poets.index') }}" class="hover:text-white transition-colors">歌人一覧</a>
                            </li>
                            <li><a href="{{ route('hyakuninisshu.by-theme', '恋') }}"
                                    class="hover:text-white transition-colors">恋の歌</a></li>
                            <li><a href="{{ route('hyakuninisshu.popular') }}"
                                    class="hover:text-white transition-colors">人気ランキング</a></li>
                        </ul>
                    </div>

                    {{-- サイト情報 --}}
                    <div>
                        <h3 class="font-bold text-gray-300 mb-4">サイト情報</h3>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="{{ route('search.index') }}" class="hover:text-white transition-colors">検索</a>
                            </li>
                            <li><a href="{{ route('daily') }}" class="hover:text-white transition-colors">今日のおすすめ</a>
                            </li>
                            <li><a href="{{ route('privacy') }}"
                                    class="hover:text-white transition-colors">プライバシーポリシー</a></li>
                            <li><a href="{{ route('terms') }}" class="hover:text-white transition-colors">利用規約</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">お問い合わせ</a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- コピーライト --}}
                <div class="border-t border-gray-800 py-6 text-center text-sm text-gray-500">
                    <p>&copy; {{ date('Y') }} Quote Vault - 名言・格言・ことわざ・百人一首サイト</p>
                </div>
            </div>
        </footer>
    </div>

    {{-- JavaScript --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')
</body>

</html>