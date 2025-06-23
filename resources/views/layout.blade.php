{{-- resources/views/layout.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '偉人の名言・格言・ことわざ・百人一首サイト')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-blue-600 text-white shadow-md">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <h1 class="font-bold {{ $agent->isMobile() ? 'text-sm' : 'text-lg' }}"> 
                <a href="{{ route('home') }}" class="hover:underline">名言・格言・ことわざ・百人一首サイト</a>
            </h1>
            
            @if($agent->isMobile())
                <!-- モバイルメニューボタン -->
                <button id="mobile-menu-btn" class="p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-8">
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
                </div>
            @endif

            <!-- コピーライト -->
            <div class="border-t border-gray-600 pt-4 text-center text-sm">
                <p>&copy; 2024 偉人の名言・格言・ことわざ・百人一首サイト</p>
            </div>
        </div>
    </footer>

    <script>
        // モバイルメニューの切り替え
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            
            if (menuBtn && menu) {
                menuBtn.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>