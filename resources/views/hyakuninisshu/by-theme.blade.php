{{-- ファイルパス: resources/views/hyakuninisshu/by-theme.blade.php --}}
@extends('layout')

@section('title', $theme . 'の歌 - 百人一首')

@section('content')
    <div class="container mx-auto px-4">
        <!-- パンくずリスト -->
        <nav class="mb-6 text-sm">
            <ol class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-purple-600">ホーム</a></li>
                <li>›</li>
                <li><a href="{{ route('hyakuninisshu.index') }}" class="hover:text-purple-600">百人一首</a></li>
                <li>›</li>
                <li class="text-gray-800 font-semibold">{{ $theme }}の歌</li>
            </ol>
        </nav>

        <!-- ページタイトル -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 text-purple-800">{{ $theme }}の歌</h1>
            <p class="text-gray-600">{{ $theme }}をテーマにした心に響く和歌をお楽しみください</p>
            <div class="mt-4">
                <span class="bg-pink-100 text-pink-800 px-4 py-2 rounded-full font-semibold">
                    💝 {{ $poems->total() }}首の{{ $theme }}の歌
                </span>
            </div>
        </div>

        <!-- テーマ切り替えナビ -->
        <div class="flex flex-wrap justify-center mb-8 gap-2">
            <div class="bg-white rounded-lg shadow p-2 flex flex-wrap gap-2">
                <a href="{{ route('hyakuninisshu.by-theme', '恋') }}" 
                   class="px-4 py-2 rounded {{ $theme === '恋' ? 'bg-pink-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    💕 恋
                </a>
                <a href="{{ route('hyakuninisshu.by-theme', '自然') }}" 
                   class="px-4 py-2 rounded {{ $theme === '自然' ? 'bg-green-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    🌿 自然
                </a>
                <a href="{{ route('hyakuninisshu.by-theme', '人生') }}" 
                   class="px-4 py-2 rounded {{ $theme === '人生' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    🌟 人生
                </a>
                <a href="{{ route('hyakuninisshu.by-theme', '別れ') }}" 
                   class="px-4 py-2 rounded {{ $theme === '別れ' ? 'bg-gray-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    😢 別れ
                </a>
                <a href="{{ route('hyakuninisshu.by-theme', '思慕') }}" 
                   class="px-4 py-2 rounded {{ $theme === '思慕' ? 'bg-purple-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition">
                    💭 思慕
                </a>
            </div>
        </div>

        <!-- テーマの特徴説明 -->
        <div class="bg-gradient-to-r 
                    @if($theme === '恋') from-pink-100 to-red-200 
                    @elseif($theme === '自然') from-green-100 to-emerald-200 
                    @elseif($theme === '人生') from-blue-100 to-indigo-200 
                    @elseif($theme === '別れ') from-gray-100 to-gray-300 
                    @else from-purple-100 to-purple-200 @endif
                    rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-3 
                      @if($theme === '恋') text-pink-800 
                      @elseif($theme === '自然') text-green-800 
                      @elseif($theme === '人生') text-blue-800 
                      @elseif($theme === '別れ') text-gray-800 
                      @else text-purple-800 @endif">
                {{ $theme }}の歌について
            </h2>
            <p class="text-gray-700">
                @if($theme === '恋')
                    恋人への想い、片思いの切なさ、恋の喜びや悲しみを詠んだ歌。平安時代の繊細な恋愛感情が表現されています。
                @elseif($theme === '自然')
                    四季の移ろい、花鳥風月の美しさを詠んだ歌。日本人の自然に対する繊細な感性が込められています。
                @elseif($theme === '人生')
                    人生の無常さ、時の流れ、人の世の儚さを詠んだ歌。深い哲学的思索が込められています。
                @elseif($theme === '別れ')
                    愛する人との別れ、友人との離別、故郷を離れる悲しみを詠んだ歌。切ない心情が表現されています。
                @else
                    憧れ、慕情、遠い人への想いを詠んだ歌。叶わぬ恋や故人への思慕が込められています。
                @endif
            </p>
        </div>

        <!-- 歌一覧 -->
        @if($poems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($poems as $poem)
                    <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 
                               @if($theme === '恋') border-pink-500 
                               @elseif($theme === '自然') border-green-500 
                               @elseif($theme === '人生') border-blue-500 
                               @elseif($theme === '別れ') border-gray-500 
                               @else border-purple-500 @endif">
                        
                        <div class="mb-3">
                            <div class="flex justify-between items-start">
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded text-sm font-semibold">
                                    {{ $poem->number }}番
                                </span>
                                @if($poem->season)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                        🌸 {{ $poem->season }}
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
                <p class="text-gray-600">{{ $theme }}をテーマにした歌は現在登録されていません。</p>
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