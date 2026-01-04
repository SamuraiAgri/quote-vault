@extends('layouts.app')

@section('title', $feature['title'] . ' - Quote Vault')
@section('meta_description', $feature['description'])

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
        <!-- ヒーローセクション -->
        <section class="relative py-16 bg-gradient-to-r from-slate-700 to-gray-800 overflow-hidden">
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

        <!-- ことわざ一覧 -->
        <section class="container mx-auto px-4 py-8">
            <div class="space-y-6">
                @forelse($proverbs as $index => $proverb)
                    <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow p-6 md:p-8">
                        <div class="flex items-start gap-4">
                            <div
                                class="hidden md:flex items-center justify-center w-12 h-12 bg-gradient-to-r from-slate-600 to-gray-700 rounded-full text-white font-bold text-lg flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">
                                    {{ $proverb->word }}
                                </h2>
                                @if($proverb->reading)
                                    <p class="text-gray-500 text-sm mb-4">
                                        読み: {{ $proverb->reading }}
                                    </p>
                                @endif
                                @if($proverb->meaning)
                                    <p class="text-gray-700 leading-relaxed mb-4">
                                        {{ Str::limit($proverb->meaning, 150) }}
                                    </p>
                                @endif
                                <div class="flex flex-wrap items-center gap-4">
                                    @if($proverb->category)
                                        <span
                                            class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm">
                                            {{ $proverb->category->name }}
                                        </span>
                                    @endif
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm">
                                        {{ $proverb->type ?? 'ことわざ' }}
                                    </span>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('proverbs.show', $proverb->id) }}"
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
                        <p class="text-gray-600">この特集のことわざは準備中です。</p>
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
                    <a href="{{ route('proverbs.popular') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-slate-600 to-gray-700 text-white rounded-full shadow hover:shadow-lg transition-all">
                        <span class="mr-2">🏆</span>
                        人気のことわざ
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection