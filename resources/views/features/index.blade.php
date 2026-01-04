@extends('layouts.app')

@section('title', '特集一覧 - Quote Vault')
@section('meta_description', '仕事で使える名言、恋愛に効く名言、落ち込んだ時に読みたい名言など、シーン別に厳選した名言特集をご紹介します。')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
        <!-- ヒーローセクション -->
        <section class="relative py-16 bg-gradient-to-r from-indigo-600 to-purple-700 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
                <div class="absolute bottom-10 right-10 w-48 h-48 bg-white rounded-full"></div>
            </div>
            <div class="container mx-auto px-4 relative z-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white text-center mb-4">
                    📚 名言特集
                </h1>
                <p class="text-white/90 text-center text-lg max-w-2xl mx-auto">
                    シーン別・目的別に厳選した名言コレクション。<br>
                    あなたの心に響く言葉がきっと見つかります。
                </p>
            </div>
        </section>

        <!-- 特集カード一覧 -->
        <section class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($features as $feature)
                    <a href="{{ route('features.' . $feature['slug']) }}"
                        class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r {{ $feature['color'] }} p-6 text-white">
                            <span class="text-4xl">{{ $feature['icon'] }}</span>
                        </div>
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition-colors">
                                {{ $feature['title'] }}
                            </h2>
                            <p class="text-gray-600">
                                {{ $feature['description'] }}
                            </p>
                            <div class="mt-4 flex items-center text-indigo-600 font-medium">
                                <span>もっと見る</span>
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- 関連コンテンツへの誘導 -->
        <section class="container mx-auto px-4 py-12">
            <div class="bg-gradient-to-r from-slate-100 to-gray-100 rounded-2xl p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    もっと名言を探す
                </h2>
                <p class="text-gray-600 mb-6">
                    カテゴリ別、著者別で名言を探すこともできます
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('largecategories.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition-all">
                        <span class="mr-2">📂</span>
                        カテゴリから探す
                    </a>
                    <a href="{{ route('authors.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition-all">
                        <span class="mr-2">👤</span>
                        著者から探す
                    </a>
                    <a href="{{ route('quotes.popular') }}"
                        class="inline-flex items-center px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition-all">
                        <span class="mr-2">🏆</span>
                        人気ランキング
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection