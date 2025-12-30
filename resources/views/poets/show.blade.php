{{-- resources/views/poets/show.blade.php --}}
@extends('layouts.app')

@section('title', $poet->name)

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '百人一首', 'url' => route('hyakuninisshu.index')],
            ['name' => '歌人一覧', 'url' => route('poets.index')],
            ['name' => $poet->name]
        ]])

        <!-- 歌人情報 -->
        <div class="bg-white shadow rounded-lg p-6 mb-8 text-center">
            <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $poet->name }}</h1>
            
            @if($poet->reading)
                <p class="text-lg text-gray-600 mb-4">{{ $poet->reading }}</p>
            @endif
            
            @if($poet->period)
                <p class="text-lg text-gray-600 mb-4">時代: {{ $poet->period }}</p>
            @endif
            
            @if($poet->biography)
                <div class="bg-gray-100 rounded-lg p-4 mt-6">
                    <h2 class="text-xl font-semibold mb-2">経歴・説明</h2>
                    <p class="text-gray-700 text-left">{{ $poet->biography }}</p>
                </div>
            @endif
        </div>

        <!-- 歌一覧 -->
        @if($poems->count() > 0)
            <h2 class="text-2xl font-semibold mb-4">{{ $poet->name }}の歌</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($poems as $poem)
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="text-blue-600 font-bold text-lg mb-2">第{{ $poem->number }}番</div>
                        <div class="text-lg text-gray-800 mb-2">{{ $poem->upper_phrase }}</div>
                        <div class="text-lg text-gray-800 mb-4">{{ $poem->lower_phrase }}</div>
                        
                        @if($poem->season)
                            <p class="text-sm text-gray-600 mb-2">季節: {{ $poem->season }}</p>
                        @endif
                        
                        @if($poem->theme)
                            <p class="text-sm text-gray-600 mb-4">テーマ: {{ $poem->theme }}</p>
                        @endif
                        
                        <a href="{{ route('hyakuninisshu.show', $poem->id) }}" class="inline-block text-blue-600 border-2 border-blue-600 hover:bg-blue-600 hover:text-white rounded px-6 py-2 transition-all duration-300">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-700 text-center">この歌人の歌はありません。</p>
        @endif
    </div>
@endsection