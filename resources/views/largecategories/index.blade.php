@extends('layout')

@section('title', '大カテゴリ一覧')

@section('content')
    <div class="container mx-auto px-4">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', ['breadcrumbs' => [
            ['name' => 'ホーム', 'url' => route('home')],
            ['name' => '名言・格言']
        ]])

        <h1 class="text-3xl font-semibold text-center mb-6">大カテゴリ一覧</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($largeCategories as $largeCategory)
                <a href="{{ route('largecategories.show', $largeCategory->id) }}" class="bg-blue-100 hover:bg-blue-200 transition rounded-lg p-4 text-center shadow block">
                    <span class="text-lg font-bold text-blue-800">
                        {{ $largeCategory->name }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
@endsection
