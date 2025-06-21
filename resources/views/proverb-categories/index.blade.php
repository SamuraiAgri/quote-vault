{{-- ファイルパス: resources/views/proverb-categories/index.blade.php --}}
@extends('layout')

@section('title', 'ことわざ・四字熟語カテゴリ一覧')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('proverbs.index') }}" class="hover:text-blue-600">ことわざ・四字熟語辞典</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">カテゴリ一覧</li>
            </ol>
        </nav>

        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4">ことわざ・四字熟語カテゴリ一覧</h1>
            <p class="text-gray-600">テーマ別に分類されたことわざ・四字熟語を探すことができます</p>
            <div class="mt-4">
                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold">
                    📚 {{ $categories->count() }}のカテゴリ
                </span>
            </div>
        </div>

        <!-- 検索ボックス -->
        <div class="bg-gray-100 rounded-lg p-4 mb-8">
            <form action="{{ route('proverbs.search') }}" method="GET" class="flex gap-4">
                <input type="text" name="q" placeholder="ことわざ・四字熟語を検索..."
                       class="flex-grow border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    検索
                </button>
            </form>
        </div>

        <!-- カテゴリ一覧 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
            @foreach($categories as $category)
                <a href="{{ route('proverb-categories.show', $category->id) }}" 
                   class="bg-white hover:bg-blue-50 shadow-lg rounded-lg p-6 text-center transition-all transform hover:scale-105 hover:shadow-xl group">
                    
                    <!-- カテゴリアイコン -->
                    <div class="text-4xl mb-4">
                        @if($category->name === '努力・勤勉') 💪
                        @elseif($category->name === '人間関係') 🤝
                        @elseif($category->name === '知恵・学問') 🧠
                        @elseif($category->name === '成功・失敗') 🎯
                        @elseif($category->name === '時間・機会') ⏰
                        @elseif($category->name === '自然・天候') 🌿
                        @elseif($category->name === '金銭・経済') 💰
                        @elseif($category->name === '健康・生活') 🏠
                        @elseif($category->name === '愛情・恋愛') ❤️
                        @elseif($category->name === '道徳・教訓') 📜
                        @else 📖
                        @endif
                    </div>

                    <!-- カテゴリ名 -->
                    <h3 class="text-lg font-bold text-blue-800 mb-3 group-hover:text-blue-600">
                        {{ $category->name }}
                    </h3>

                    <!-- カテゴリ説明 -->
                    @if($category->description)
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                            {{ $category->description }}
                        </p>
                    @endif

                    <!-- 件数表示 -->
                    <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold inline-block mb-2">
                        {{ $category->proverbs_count }}件
                    </div>

                    <!-- 人気度表示 -->
                    <div class="text-xs text-gray-500">
                        @if($category->proverbs_count > 20)
                            人気カテゴリ ⭐⭐⭐
                        @elseif($category->proverbs_count > 10)
                            おすすめ ⭐⭐
                        @else
                            ⭐
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        <!-- カテゴリ説明セクション -->
        <section class="mb-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-8">
            <h2 class="text-2xl font-semibold mb-6 text-center text-blue-800">カテゴリについて</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg p-4 shadow">
                    <h3 class="font-bold text-blue-700 mb-2">📚 学習効果</h3>
                    <p class="text-sm text-gray-700">テーマ別に分類されているため、特定の分野の知識を深めることができます。</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow">
                    <h3 class="font-bold text-blue-700 mb-2">🎯 実用性</h3>
                    <p class="text-sm text-gray-700">場面や状況に応じて適切なことわざ・四字熟語を見つけることができます。</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow">
                    <h3 class="font-bold text-blue-700 mb-2">💡 理解促進</h3>
                    <p class="text-sm text-gray-700">関連する内容がまとめられているため、より深い理解が得られます。</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow">
                    <h3 class="font-bold text-blue-700 mb-2">🔍 発見</h3>
                    <p class="text-sm text-gray-700">知らなかった新しいことわざ・四字熟語に出会うことができます。</p>
                </div>
            </div>
        </section>

        <!-- 戻るボタン -->
        <div class="text-center">
            <a href="{{ route('proverbs.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← ことわざ・四字熟語辞典トップに戻る
            </a>
        </div>
    </div>
@endsection