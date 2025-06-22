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
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="font-bold 
            @if($agent->isMobile()) text-sm @else text-lg @endif"> 
            <!-- モバイルの場合はテキストを小さくする -->
            <a href="{{ route('home') }}" class="hover:underline">名言・格言サイト</a>
        </h1>
        <ul class="flex space-x-4 
            @if($agent->isMobile()) text-xs @else text-lg @endif"> 
            <!-- モバイル時にテキストを小さくする -->
            <li><a href="{{ route('largecategories.index') }}" class="hover:underline py-2">大カテゴリ一覧</a></li>
            <li><a href="{{ route('authors.index') }}" class="hover:underline py-2">著者一覧</a></li>
            <li><a href="{{ route('quotes.popular') }}" class="hover:underline py-2">人気の名言</a></li>
            <li><a href="{{ route('search.index') }}" class="hover:underline py-2">検索</a></li>
        </ul>
    </nav>
</header>

    <main class="container mx-auto px-4 py-6">
        @yield('content')

        <!-- 人気の名言セクション -->
        <section class="mb-8 py-8"> <!-- セクション間の余白を強化 -->
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
        <section class="mb-2 py-2"> <!-- セクション間の余白を強化 -->
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
    </main>

    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; 2024 偉人の名言・格言サイト</p>
    </footer>
</body>
</html>
