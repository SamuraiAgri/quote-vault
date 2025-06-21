{{-- ファイルパス: resources/views/poets/index.blade.php --}}
@extends('layout')

@section('title', '歌人一覧 - 百人一首')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-purple-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('hyakuninisshu.index') }}" class="hover:text-purple-600">百人一首</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">歌人一覧</li>
            </ol>
        </nav>

        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 text-purple-800">歌人一覧</h1>
            <p class="text-gray-600">百人一首に収められた和歌の作者たち</p>
            <div class="mt-4">
                <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full font-semibold">
                    {{ $poets->count() }}人の歌人
                </span>
            </div>
        </div>

        <!-- 時代別フィルター -->
        <div class="mb-8">
            <div class="flex flex-wrap justify-center gap-2">
                <button onclick="filterByPeriod('')" 
                        class="period-filter active bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm">
                    すべて
                </button>
                <button onclick="filterByPeriod('飛鳥時代')" 
                        class="period-filter bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                    飛鳥時代
                </button>
                <button onclick="filterByPeriod('奈良時代')" 
                        class="period-filter bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                    奈良時代
                </button>
                <button onclick="filterByPeriod('平安時代')" 
                        class="period-filter bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                    平安時代
                </button>
                <button onclick="filterByPeriod('鎌倉時代')" 
                        class="period-filter bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                    鎌倉時代
                </button>
            </div>
        </div>

        <!-- 歌人一覧 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="poets-grid">
            @foreach($poets as $poet)
                <div class="poet-card bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition" 
                     data-period="{{ $poet->period }}">
                    <div class="text-center mb-4">
                        <h3 class="text-xl font-bold text-purple-800 mb-2">{{ $poet->name }}</h3>
                        @if($poet->reading)
                            <p class="text-sm text-gray-600 mb-2">{{ $poet->reading }}</p>
                        @endif
                        @if($poet->period)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                {{ $poet->period }}
                            </span>
                        @endif
                    </div>

                    @if($poet->biography)
                        <div class="mb-4">
                            <p class="text-sm text-gray-700 leading-relaxed">{{ Str::limit($poet->biography, 120) }}</p>
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <span class="bg-purple-50 text-purple-700 px-3 py-1 rounded text-sm font-medium">
                            {{ $poet->hyakuninisshu_count }}首収録
                        </span>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('poets.show', $poet->id) }}" 
                           class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm font-semibold">
                            歌を見る
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 時代ごとの特色説明 -->
        <section class="mt-12 mb-8">
            <h2 class="text-2xl font-semibold mb-6 text-center">時代ごとの特色</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-red-100 to-red-200 p-6 rounded-lg">
                    <h3 class="font-bold text-red-800 mb-2">飛鳥時代</h3>
                    <p class="text-sm text-red-700">天皇を中心とした宮廷歌人。大らかで力強い歌風。</p>
                </div>
                <div class="bg-gradient-to-br from-orange-100 to-orange-200 p-6 rounded-lg">
                    <h3 class="font-bold text-orange-800 mb-2">奈良時代</h3>
                    <p class="text-sm text-orange-700">万葉集の時代。自然詠や叙景歌に優れた歌人たち。</p>
                </div>
                <div class="bg-gradient-to-br from-purple-100 to-purple-200 p-6 rounded-lg">
                    <h3 class="font-bold text-purple-800 mb-2">平安時代</h3>
                    <p class="text-sm text-purple-700">華やかな王朝文化。恋歌や風雅な歌が中心。</p>
                </div>
                <div class="bg-gradient-to-br from-green-100 to-green-200 p-6 rounded-lg">
                    <h3 class="font-bold text-green-800 mb-2">鎌倉時代</h3>
                    <p class="text-sm text-green-700">武家社会の影響。より写実的で力強い歌風。</p>
                </div>
            </div>
        </section>
    </div>

    <script>
        function filterByPeriod(period) {
            const cards = document.querySelectorAll('.poet-card');
            const filters = document.querySelectorAll('.period-filter');
            
            // フィルターボタンのスタイル更新
            filters.forEach(filter => {
                filter.classList.remove('active', 'bg-purple-600', 'text-white');
                filter.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            event.target.classList.add('active', 'bg-purple-600', 'text-white');
            event.target.classList.remove('bg-gray-200', 'text-gray-700');
            
            // カードのフィルタリング
            cards.forEach(card => {
                if (period === '' || card.dataset.period === period) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
@endsection