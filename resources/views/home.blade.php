{{-- ファイルパス: resources/views/home.blade.php --}}
@extends('layout')

@section('title', 'ホーム')

@section('content')
    <div class="relative">
        <!-- メインタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-4 text-gray-800">名言・格言・ことわざ・百人一首の総合サイト</h1>
            <p class="text-lg text-gray-600 mb-6">偉人の名言から四字熟語、百人一首まで幅広く学べるサイトです</p>
        </div>

        <!-- メイン画像 -->
        <div class="relative mb-12">
            <img src="{{ asset('img/ijin.png') }}" alt="偉人のシルエット" class="w-full h-auto object-cover mx-auto" style="max-height: 600px; object-position: top;">
        </div>

        <!-- 3つのメインコンテンツセクション -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-center mb-8 text-gray-800">サイト内容</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- 名言・格言 -->
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="text-5xl mb-4">💬</div>
                    <h3 class="text-2xl font-bold mb-4 text-blue-800">名言・格言</h3>
                    <p class="text-gray-600 mb-6">偉人たちの心に響く言葉を著者別・カテゴリ別で探せます</p>
                    <div class="space-y-3">
                        <a href="{{ route('largecategories.index') }}" 
                           class="block bg-blue-100 hover:bg-blue-200 text-blue-800 px-4 py-2 rounded transition">
                            大カテゴリ一覧
                        </a>
                        <a href="{{ route('authors.index') }}" 
                           class="block bg-blue-100 hover:bg-blue-200 text-blue-800 px-4 py-2 rounded transition">
                            著者一覧
                        </a>
                        <a href="{{ route('quotes.popular') }}" 
                           class="block bg-blue-100 hover:bg-blue-200 text-blue-800 px-4 py-2 rounded transition">
                            人気の名言
                        </a>
                    </div>
                </div>

                <!-- ことわざ・四字熟語 -->
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="text-5xl mb-4">📖</div>
                    <h3 class="text-2xl font-bold mb-4 text-green-800">ことわざ・四字熟語</h3>
                    <p class="text-gray-600 mb-6">日本の伝統的な言葉の知恵を意味と用例で学べます</p>
                    <div class="space-y-3">
                        <a href="{{ route('proverbs.by-type', 'ことわざ') }}" 
                           class="block bg-red-100 hover:bg-red-200 text-red-800 px-4 py-2 rounded transition">
                            ことわざ一覧
                        </a>
                        <a href="{{ route('proverbs.by-type', '四字熟語') }}" 
                           class="block bg-green-100 hover:bg-green-200 text-green-800 px-4 py-2 rounded transition">
                            四字熟語一覧
                        </a>
                        <a href="{{ route('proverbs.by-type', '慣用句') }}" 
                           class="block bg-purple-100 hover:bg-purple-200 text-purple-800 px-4 py-2 rounded transition">
                            慣用句一覧
                        </a>
                    </div>
                </div>

                <!-- 百人一首 -->
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="text-5xl mb-4">🎋</div>
                    <h3 class="text-2xl font-bold mb-4 text-purple-800">百人一首・和歌</h3>
                    <p class="text-gray-600 mb-6">古典和歌の傑作100首を現代語訳とともに学べます</p>
                    <div class="space-y-3">
                        <a href="{{ route('hyakuninisshu.index') }}" 
                           class="block bg-purple-100 hover:bg-purple-200 text-purple-800 px-4 py-2 rounded transition">
                            百人一首一覧
                        </a>
                        <a href="{{ route('poets.index') }}" 
                           class="block bg-purple-100 hover:bg-purple-200 text-purple-800 px-4 py-2 rounded transition">
                            歌人一覧
                        </a>
                        <a href="{{ route('hyakuninisshu.by-season', '春') }}" 
                           class="block bg-purple-100 hover:bg-purple-200 text-purple-800 px-4 py-2 rounded transition">
                            季節別に探す
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 検索セクション -->
        <section class="mb-12 bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100 rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">各コンテンツを検索</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- 名言検索 -->
                <div class="bg-white rounded-lg p-6 shadow">
                    <h3 class="font-bold text-blue-800 mb-3">名言・格言を検索</h3>
                    <form action="{{ route('search.index') }}" method="GET">
                        <input type="text" name="q" placeholder="著者名や名言を検索..."
                               class="w-full border border-gray-300 rounded p-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                            名言を検索
                        </button>
                    </form>
                </div>

                <!-- ことわざ検索 -->
                <div class="bg-white rounded-lg p-6 shadow">
                    <h3 class="font-bold text-green-800 mb-3">ことわざ・四字熟語を検索</h3>
                    <form action="{{ route('proverbs.search') }}" method="GET">
                        <input type="text" name="q" placeholder="ことわざ、意味を検索..."
                               class="w-full border border-gray-300 rounded p-2 mb-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <button type="submit" 
                                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                            ことわざを検索
                        </button>
                    </form>
                </div>

                <!-- 百人一首検索 -->
                <div class="bg-white rounded-lg p-6 shadow">
                    <h3 class="font-bold text-purple-800 mb-3">百人一首を検索</h3>
                    <form action="{{ route('hyakuninisshu.search') }}" method="GET">
                        <input type="text" name="q" placeholder="歌の内容、歌人を検索..."
                               class="w-full border border-gray-300 rounded p-2 mb-3 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <button type="submit" 
                                class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700 transition">
                            和歌を検索
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- 人気コンテンツセクション -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-center mb-8 text-gray-800">人気のコンテンツ</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- 人気の名言 -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-blue-800 flex items-center">
                        <span class="mr-2">💬</span>人気の名言
                    </h3>
                    <div class="space-y-4">
                        @foreach($popularQuotes->take(3) as $quote)
                            <div class="bg-white shadow rounded p-4">
                                <blockquote class="text-sm text-gray-800 italic mb-2">"{{ Str::limit($quote->quote_text, 60) }}"</blockquote>
                                <p class="text-xs text-gray-600">- {{ $quote->author->name }}</p>
                                <a href="{{ route('quotes.show', $quote->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-xs">詳細 →</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('quotes.popular') }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold">もっと見る →</a>
                    </div>
                </div>

                <!-- 人気のことわざ・四字熟語 -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-green-800 flex items-center">
                        <span class="mr-2">📖</span>人気のことわざ・四字熟語
                    </h3>
                    <div class="space-y-4">
                        @php
                            try {
                                $popularProverbs = class_exists('App\Models\Proverb') ? App\Models\Proverb::popular()->limit(3)->get() : collect();
                            } catch (Exception $e) {
                                $popularProverbs = collect();
                            }
                        @endphp
                        @forelse($popularProverbs as $proverb)
                            <div class="bg-white shadow rounded p-4">
                                <h4 class="font-bold text-sm text-gray-800 mb-1">{{ $proverb->word }}</h4>
                                <p class="text-xs text-gray-600 mb-2">{{ Str::limit($proverb->meaning, 50) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">{{ $proverb->type }}</span>
                                    <a href="{{ route('proverbs.show', $proverb->id) }}" 
                                       class="text-green-600 hover:text-green-800 text-xs">詳細 →</a>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white shadow rounded p-4 text-center">
                                <p class="text-gray-500 text-sm">ことわざ・四字熟語を準備中です</p>
                                <a href="{{ route('proverbs.index') }}" class="text-green-600 hover:text-green-800 text-xs">詳細ページへ →</a>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('proverbs.popular') }}" 
                           class="text-green-600 hover:text-green-800 font-semibold">もっと見る →</a>
                    </div>
                </div>

                <!-- 人気の百人一首 -->
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-purple-800 flex items-center">
                        <span class="mr-2">🎋</span>人気の百人一首
                    </h3>
                    <div class="space-y-4">
                        @php
                            try {
                                $popularPoems = class_exists('App\Models\Hyakuninisshu') ? App\Models\Hyakuninisshu::popular()->limit(3)->get() : collect();
                            } catch (Exception $e) {
                                $popularPoems = collect();
                            }
                        @endphp
                        @forelse($popularPoems as $poem)
                            <div class="bg-white shadow rounded p-4">
                                <div class="mb-2">
                                    <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">{{ $poem->number }}番</span>
                                </div>
                                <p class="text-sm text-gray-800 mb-2 font-medium">{{ Str::limit($poem->upper_phrase . ' ' . $poem->lower_phrase, 40) }}</p>
                                <p class="text-xs text-gray-600 mb-2">- {{ $poem->poet->name }}</p>
                                <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                                   class="text-purple-600 hover:text-purple-800 text-xs">詳細 →</a>
                            </div>
                        @empty
                            <div class="bg-white shadow rounded p-4 text-center">
                                <p class="text-gray-500 text-sm">百人一首を準備中です</p>
                                <a href="{{ route('hyakuninisshu.index') }}" class="text-purple-600 hover:text-purple-800 text-xs">詳細ページへ →</a>
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('hyakuninisshu.popular') }}" 
                           class="text-purple-600 hover:text-purple-800 font-semibold">もっと見る →</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 大カテゴリ一覧（名言・格言用） -->
        <section>
            <h2 class="text-2xl font-semibold py-8">名言・格言の大カテゴリ一覧</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($largeCategories as $largeCategory)
                    <div class="bg-blue-100 rounded-lg shadow-lg p-4 text-center hover:bg-blue-200 transition-all">
                        <a href="{{ route('largecategories.show', $largeCategory->id) }}" class="text-blue-700 font-semibold">
                            {{ $largeCategory->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection