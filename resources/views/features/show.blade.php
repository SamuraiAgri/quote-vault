@extends('layouts.app')

@section('title', $feature['title'] . ' - Quote Vault')
@section('meta_description', $feature['description'])

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
        <!-- ヒーローセクション -->
        <section class="relative py-16 bg-gradient-to-r from-indigo-600 to-purple-700 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
                <div class="absolute bottom-10 right-10 w-48 h-48 bg-white rounded-full"></div>
            </div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center">
                    <span class="text-5xl mb-4 block">{{ $feature['icon'] }}</span>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                        {{ $feature['title'] }}
                    </h1>
                    <p class="text-white/90 text-lg max-w-2xl mx-auto">
                        {{ $feature['description'] }}
                    </p>
                </div>
            </div>
        </section>

        <!-- パンくずリスト -->
        <nav class="container mx-auto px-4 py-4">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-indigo-600">ホーム</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('features.index') }}" class="hover:text-indigo-600">特集一覧</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-900 font-medium">{{ $feature['title'] }}</li>
            </ol>
        </nav>

        <!-- 名言一覧 -->
        <section class="container mx-auto px-4 py-8">
            <div class="space-y-6">
                @forelse($quotes as $index => $quote)
                    <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow p-6 md:p-8">
                        <div class="flex items-start gap-4">
                            <div
                                class="hidden md:flex items-center justify-center w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full text-white font-bold text-lg flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <blockquote class="text-xl md:text-2xl font-medium text-gray-800 leading-relaxed mb-4">
                                    "{{ $quote->quote_text }}"
                                </blockquote>
                                <div class="flex flex-wrap items-center gap-4 text-gray-600">
                                    <a href="{{ route('authors.show', $quote->author_id) }}"
                                        class="flex items-center hover:text-indigo-600 transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $quote->author->name }}
                                    </a>
                                    <a href="{{ route('categories.show', $quote->category_id) }}"
                                        class="flex items-center hover:text-indigo-600 transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        {{ $quote->category->name }}
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('quotes.show', $quote->id) }}"
                                        class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                                        詳細を見る
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="text-center py-12 bg-white rounded-2xl shadow">
                        <p class="text-gray-600">この特集の名言は準備中です。</p>
                        <a href="{{ route('features.index') }}" class="mt-4 inline-block text-indigo-600 hover:underline">
                            他の特集を見る
                        </a>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- 他の特集への誘導 -->
        <section class="container mx-auto px-4 py-12">
            <div class="bg-gradient-to-r from-slate-100 to-gray-100 rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                    📚 他の特集も見る
                </h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('features.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition-all">
                        <span class="mr-2">📖</span>
                        特集一覧へ戻る
                    </a>
                    <a href="{{ route('quotes.popular') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-full shadow hover:shadow-lg transition-all">
                        <span class="mr-2">🏆</span>
                        人気ランキング
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection