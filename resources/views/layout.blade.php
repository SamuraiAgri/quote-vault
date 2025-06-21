{{-- ファイルパス: resources/views/layout.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '偉人の名言・格言サイト')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-blue-600 text-white shadow-md">
    <nav class="container mx-auto px-4 py-4">
        <!-- サイトタイトル -->
        <div class="flex justify-between items-center mb-2">
            <h1 class="font-bold @if($agent->isMobile()) text-sm @else text-lg @endif"> 
                <a href="{{ route('home') }}" class="hover:underline">名言・格言・ことわざサイト</a>
            </h1>
        </div>

        <!-- メインナビゲーション -->
        <div class="@if($agent->isMobile()) text-xs @else text-sm @endif">
            <!-- 名言・格言セクション -->
            <div class="mb-2">
                <span class="font-semibold text-yellow-300">【名言・格言】</span>
                <ul class="inline-flex space-x-3 ml-2">
                    <li><a href="{{ route('largecategories.index') }}" class="hover:underline">大カテゴリ一覧</a></li>
                    <li><a href="{{ route('authors.index') }}" class="hover:underline">著者一覧</a></li>
                    <li><a href="{{ route('quotes.popular') }}" class="hover:underline">人気の名言</a></li>
                    <li><a href="{{ route('search.index') }}" class="hover:underline">検索</a></li>
                </ul>
            </div>

            <!-- ことわざ・四字熟語セクション -->
            <div class="mb-2">
                <span class="font-semibold text-yellow-300">【ことわざ・四字熟語】</span>
                <ul class="inline-flex space-x-3 ml-2">
                    <li><a href="{{ route('proverbs.index') }}" class="hover:underline">トップ</a></li>
                    <li><a href="{{ route('proverbs.by-type', 'ことわざ') }}" class="hover:underline">ことわざ</a></li>
                    <li><a href="{{ route('proverbs.by-type', '四字熟語') }}" class="hover:underline">四字熟語</a></li>
                    <li><a href="{{ route('proverbs.by-type', '慣用句') }}" class="hover:underline">慣用句</a></li>
                    <li><a href="{{ route('proverbs.search') }}" class="hover:underline">検索</a></li>
                </ul>
            </div>

            <!-- 百人一首セクション -->
            <div>
                <span class="font-semibold text-yellow-300">【百人一首】</span>
                <ul class="inline-flex space-x-3 ml-2">
                    <li><a href="{{ route('hyakuninisshu.index') }}" class="hover:underline">百人一首</a></li>
                    <li><a href="{{ route('poets.index') }}" class="hover:underline">歌人一覧</a></li>
                    <li><a href="{{ route('hyakuninisshu.popular') }}" class="hover:underline">人気の歌</a></li>
                    <li><a href="{{ route('hyakuninisshu.search') }}" class="hover:underline">検索</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

    <main class="container mx-auto px-4 py-6">
        @yield('content')

        <!-- 現在のページに応じてコンテンツを表示 -->
        @if(Request::is('/'))
            <!-- ホームページの場合は人気の名言セクション -->
            <section class="mb-8 py-8">
                <h2 class="text-2xl font-semibold mb-4 mt-8">人気の名言</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($popularQuotes as $quote)
                        <div class="bg-white shadow rounded p-6">
                            <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                            <p class="text-sm text-gray-600">- {{ $quote->author->name }}</p>
                            <a href="{{ route('quotes.show', $quote->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 mt-4 transition-all duration-300">
                                詳細を見る
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- 直近でアクセスされた名言セクション -->
            <section class="mb-2 py-2">
                <h2 class="text-2xl font-semibold mb-4 mt-2">直近でアクセスされた名言</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($recentQuotes as $quote)
                        <div class="bg-white shadow rounded p-6">
                            <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                            <p class="text-sm text-gray-600">- {{ $quote->author->name }}</p>
                            <a href="{{ route('quotes.show', $quote->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 mt-4 transition-all duration-300">
                                詳細を見る
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <!-- サイト説明 -->
            <div class="text-center mb-6">
                <p class="text-lg font-semibold mb-2">名言・格言・ことわざ・百人一首の総合サイト</p>
                <p class="text-sm text-gray-300">偉人の名言から四字熟語、百人一首まで幅広く学べるサイトです</p>
            </div>

            <!-- フッターメニュー -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                <!-- 名言・格言 -->
                <div>
                    <h3 class="text-lg font-semibold mb-3 text-yellow-300">名言・格言</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('largecategories.index') }}" class="hover:text-yellow-300">大カテゴリ一覧</a></li>
                        <li><a href="{{ route('authors.index') }}" class="hover:text-yellow-300">著者一覧</a></li>
                        <li><a href="{{ route('quotes.popular') }}" class="hover:text-yellow-300">人気の名言ランキング</a></li>
                        <li><a href="{{ route('search.index') }}" class="hover:text-yellow-300">名言検索</a></li>
                    </ul>
                </div>

                <!-- ことわざ・四字熟語 -->
                <div>
                    <h3 class="text-lg font-semibold mb-3 text-yellow-300">ことわざ・四字熟語辞典</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('proverbs.index') }}" class="hover:text-yellow-300">ことわざ・四字熟語トップ</a></li>
                        <li><a href="{{ route('proverbs.by-type', 'ことわざ') }}" class="hover:text-yellow-300">ことわざ一覧</a></li>
                        <li><a href="{{ route('proverbs.by-type', '四字熟語') }}" class="hover:text-yellow-300">四字熟語一覧</a></li>
                        <li><a href="{{ route('proverbs.by-type', '慣用句') }}" class="hover:text-yellow-300">慣用句一覧</a></li>
                        <li><a href="{{ route('proverb-categories.index') }}" class="hover:text-yellow-300">カテゴリ一覧</a></li>
                        <li><a href="{{ route('proverbs.search') }}" class="hover:text-yellow-300">ことわざ検索</a></li>
                    </ul>
                </div>

                <!-- 百人一首 -->
                <div>
                    <h3 class="text-lg font-semibold mb-3 text-yellow-300">百人一首・和歌</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('hyakuninisshu.index') }}" class="hover:text-yellow-300">百人一首一覧</a></li>
                        <li><a href="{{ route('poets.index') }}" class="hover:text-yellow-300">歌人一覧</a></li>
                        <li><a href="{{ route('hyakuninisshu.by-season', '春') }}" class="hover:text-yellow-300">季節別（春夏秋冬）</a></li>
                        <li><a href="{{ route('hyakuninisshu.by-theme', '恋') }}" class="hover:text-yellow-300">テーマ別</a></li>
                        <li><a href="{{ route('hyakuninisshu.popular') }}" class="hover:text-yellow-300">人気の歌</a></li>
                        <li><a href="{{ route('hyakuninisshu.search') }}" class="hover:text-yellow-300">和歌検索</a></li>
                    </ul>
                </div>
            </div>

            <!-- コピーライト -->
            <div class="text-center border-t border-gray-600 pt-4">
                <p class="text-sm">&copy; 2024 名言・格言・ことわざ・百人一首サイト</p>
            </div>
        </div>
    </footer>
</body>
</html>