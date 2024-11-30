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
            <h1 class="text-lg font-bold">名言・格言サイト</h1>
            <ul class="flex space-x-4">
                <li><a href="{{ route('home') }}" class="hover:underline">ホーム</a></li>
                <li><a href="{{ route('largecategories.index') }}" class="hover:underline">大カテゴリ一覧</a></li>
                <li><a href="{{ route('authors.index') }}" class="hover:underline">著者一覧</a></li>
                <li><a href="{{ route('quotes.popular') }}" class="hover:underline">人気の名言</a></li>
                <li><a href="{{ route('search.index') }}" class="hover:underline">検索</a></li>
            </ul>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-6">
        @yield('content')
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">人気の名言</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularQuotes as $quote)
                    <div class="bg-white shadow rounded p-6">
                        <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                        <p class="text-sm text-gray-600">- {{ $quote->author->name }}</p>
                        <a href="{{ route('quotes.show', $quote->id) }}" class="text-blue-500 underline mt-2 block">詳細を見る</a>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">直近でアクセスされた名言</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recentQuotes as $quote)
                    <div class="bg-white shadow rounded p-6">
                        <blockquote class="text-lg text-gray-800 italic mb-4">"{{ $quote->quote_text }}"</blockquote>
                        <p class="text-sm text-gray-600">- {{ $quote->author->name }}</p>
                        <a href="{{ route('quotes.show', $quote->id) }}" class="text-blue-500 underline mt-2 block">詳細を見る</a>
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
