{{-- ファイルパス: resources/views/hyakuninisshu/by-season.blade.php --}}
@extends('layout')

@section('title', $season . 'の歌 - 百人一首')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-purple-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('hyakuninisshu.index') }}" class="hover:text-purple-600">百人一首</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">{{ $season }}の歌</li>
            </ol>
        </nav>

        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 text-purple-800">{{ $season }}の歌</h1>
            <p class="text-gray-600">{{ $season }}をテーマにした美しい和歌をお楽しみください</p>
            <div class="mt-4">
                <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold">
                    🌸 {{ $poems->total() }}首の{{ $season }}の歌
                </span>
            </div>
        </div>

        <!-- 季節切り替えナビ -->
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg shadow p-2 flex space-x-2">
                <a href="{{ route('hyakuninisshu.by-season', '春') }}" 
                   class="px-4 py-2 rounded {{ $season === '春' ? 'bg-pink-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    🌸 春
                </a>
                <a href="{{ route('hyakuninisshu.by-season', '夏') }}" 
                   class="px-4 py-2 rounded {{ $season === '夏' ? 'bg-green-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    🌻 夏
                </a>
                <a href="{{ route('hyakuninisshu.by-season', '秋') }}" 
                   class="px-4 py-2 rounded {{ $season === '秋' ? 'bg-orange-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    🍁 秋
                </a>
                <a href="{{ route('hyakuninisshu.by-season', '冬') }}" 
                   class="px-4 py-2 rounded {{ $season === '冬' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    ❄️ 冬
                </a>
            </div>
        </div>

        <!-- 季節の特徴説明 -->
        <div class="bg-gradient-to-r 
                    @if($season === '春') from-pink-100 to-pink-200 
                    @elseif($season === '夏') from-green-100 to-green-200 
                    @elseif($season === '秋') from-orange-100 to-orange-200 
                    @else from-blue-100 to-blue-200 @endif
                    rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-3 
                      @if($season === '春') text-pink-800 
                      @elseif($season === '夏') text-green-800 
                      @elseif($season === '秋') text-orange-800 
                      @else text-blue-800 @endif">
                {{ $season }}の歌について
            </h2>
            <p class="text-gray-700">
                @if($season === '春')
                    桜の花や新緑、出会いと別れの季節を詠んだ歌。華やかで希望に満ちた歌が多く見られます。
                @elseif($season === '夏')
                    青葉や暑さ、蝉の声など夏の風物詩を詠んだ歌。生命力あふれる表現が特徴的です。
                @elseif($season === '秋')
                    紅葉や月、もの思いの季節を詠んだ歌。美しくも切ない情緒が込められています。
                @else
                    雪や氷、寒さの中にも美しさを見出した歌。静寂と清廉さが表現されています。
                @endif
            </p>
        </div>

        <!-- 歌一覧 -->
        @if($poems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($poems as $poem)
                    <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 
                               @if($season === '春') border-pink-500 
                               @elseif($season === '夏') border-green-500 
                               @elseif($season === '秋') border-orange-500 
                               @else border-blue-500 @endif">
                        
                        <div class="mb-3">
                            <div class="flex justify-between items-start">
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded text-sm font-semibold">
                                    {{ $poem->number }}番
                                </span>
                                @if($poem->theme)
                                    <span class="bg-pink-100 text-pink-800 px-2 py-1 rounded text-xs">
                                        {{ $poem->theme }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-lg font-medium text-gray-800 leading-relaxed mb-2 font-serif">
                                {{ $poem->upper_phrase }}<br>
                                {{ $poem->lower_phrase }}
                            </p>
                            <p class="text-sm text-purple-600">
                                <a href="{{ route('poets.show', $poem->poet->id) }}" class="hover:text-purple-800">
                                    {{ $poem->poet->name }}
                                </a>
                            </p>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-700">{{ Str::limit($poem->modern_translation, 80) }}</p>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $poem->access_count }}回閲覧</span>
                            <a href="{{ route('hyakuninisshu.show', $poem->id) }}" 
                               class="text-purple-600 hover:text-purple-800 font-semibold text-sm">詳細を見る →</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ページネーション -->
            <div class="mb-8">
                {{ $poems->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">😔</div>
                <p class="text-gray-600">{{ $season }}の歌は現在登録されていません。</p>
            </div>
        @endif

        <!-- ナビゲーション -->
        <div class="flex justify-center space-x-4 mb-8">
            <a href="{{ route('hyakuninisshu.index') }}" 
               class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                ← 百人一首一覧に戻る
            </a>
            <a href="{{ route('hyakuninisshu.search') }}" 
               class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">
                和歌を検索
            </a>
        </div>
    </div>
@endsection