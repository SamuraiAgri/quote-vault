{{-- resources/views/largecategories/index-new.blade.php --}}
{{-- リニューアルされた大カテゴリ一覧ページ --}}
@extends('layouts.app')

@section('title', '名言・格言をテーマから探す | Quote Vault')

@section('meta_description', '名言・格言をテーマ別に分類。努力、人生、愛、友情、成功、失敗など、心の状態や学びたいテーマから名言を探せます。')

@section('content')
<div class="space-y-8">
    {{-- パンくずリスト --}}
    @include('components.breadcrumbs', ['breadcrumbs' => [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => '名言・格言 テーマ一覧']
    ]])

    {{-- ページヘッダー --}}
    <section class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-3xl p-8 md:p-12 text-white text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">テーマから名言を探す</h1>
        <p class="text-purple-100 max-w-2xl mx-auto">
            心に響く言葉をテーマ別にご紹介します。今のあなたにぴったりの言葉を見つけましょう。
        </p>
    </section>

    {{-- テーマカテゴリ --}}
    <section>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $colors = [
                ['from-blue-500', 'to-blue-600', 'bg-blue-100', 'text-blue-700', 'border-blue-200'],
                ['from-indigo-500', 'to-indigo-600', 'bg-indigo-100', 'text-indigo-700', 'border-indigo-200'],
                ['from-purple-500', 'to-purple-600', 'bg-purple-100', 'text-purple-700', 'border-purple-200'],
                ['from-pink-500', 'to-pink-600', 'bg-pink-100', 'text-pink-700', 'border-pink-200'],
                ['from-rose-500', 'to-rose-600', 'bg-rose-100', 'text-rose-700', 'border-rose-200'],
                ['from-orange-500', 'to-orange-600', 'bg-orange-100', 'text-orange-700', 'border-orange-200'],
                ['from-amber-500', 'to-amber-600', 'bg-amber-100', 'text-amber-700', 'border-amber-200'],
                ['from-emerald-500', 'to-emerald-600', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-200'],
                ['from-teal-500', 'to-teal-600', 'bg-teal-100', 'text-teal-700', 'border-teal-200'],
                ['from-cyan-500', 'to-cyan-600', 'bg-cyan-100', 'text-cyan-700', 'border-cyan-200'],
            ];
            @endphp
            
            @foreach($largeCategories as $index => $category)
            @php
            $color = $colors[$index % count($colors)];
            @endphp
            <a 
                href="{{ route('largecategories.show', $category->id) }}" 
                class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border {{ $color[4] }}"
            >
                {{-- 装飾的背景 --}}
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br {{ $color[0] }} {{ $color[1] }} opacity-10 rounded-bl-full transform translate-x-4 -translate-y-4 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="p-6 relative z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br {{ $color[0] }} {{ $color[1] }} rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-800 group-hover:text-indigo-700 transition-colors">
                                {{ $category->name }}
                            </h2>
                            <p class="text-sm text-gray-500">{{ $category->categories->count() }}個のサブカテゴリ</p>
                        </div>
                    </div>
                    
                    {{-- サブカテゴリプレビュー --}}
                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach($category->categories->take(4) as $subCat)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $color[2] }} {{ $color[3] }}">
                            {{ $subCat->name }}
                        </span>
                        @endforeach
                        @if($category->categories->count() > 4)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-600">
                            +{{ $category->categories->count() - 4 }}
                        </span>
                        @endif
                    </div>
                </div>
                
                {{-- 矢印 --}}
                <div class="absolute bottom-4 right-4 w-8 h-8 bg-gray-100 group-hover:bg-indigo-100 rounded-full flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    {{-- 別の探し方への誘導 --}}
    <section class="bg-gradient-to-r from-gray-50 to-indigo-50 rounded-3xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">別の方法で探す</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('authors.index') }}" class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-all group">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">偉人から探す</h3>
                <p class="text-sm text-gray-500">歴史上の偉人たちの名言を50音順で検索</p>
            </a>
            
            <a href="{{ route('search.index') }}" class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-all group">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">キーワードで検索</h3>
                <p class="text-sm text-gray-500">特定のキーワードから名言を検索</p>
            </a>
            
            <a href="{{ route('random.quote') }}" class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-all group">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">ランダムで出会う</h3>
                <p class="text-sm text-gray-500">偶然の出会いで新しい名言を発見</p>
            </a>
        </div>
    </section>
</div>
@endsection
