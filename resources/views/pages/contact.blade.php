{{-- resources/views/pages/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'お問い合わせ - 名言・格言・ことわざ・百人一首サイト')

@section('meta_description', '当サイトへのお問い合わせはこちらから。ご質問、ご意見、ご要望などをお気軽にお寄せください。')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- パンくずリスト --}}
    @include('components.breadcrumbs', ['breadcrumbs' => [
        ['name' => 'ホーム', 'url' => route('home')],
        ['name' => 'お問い合わせ']
    ]])

    <h1 class="text-3xl font-bold mb-6">お問い合わせ</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <p class="mb-4 text-gray-700">
            当サイトに関するご質問、ご意見、ご要望、不具合の報告などがございましたら、以下の方法でお問い合わせください。
        </p>
    </div>

    <section class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4 text-blue-700">お問い合わせ方法</h2>
        <div class="space-y-4 text-gray-700">
            <p>お問い合わせは、下記の情報を記載の上、メールにてお送りください：</p>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="font-semibold mb-2">お問い合わせ先メールアドレス</p>
                <p class="text-lg text-blue-700">
                    <a href="mailto:contact@example.com" class="hover:underline">
                        contact@example.com
                    </a>
                </p>
                <p class="text-sm text-gray-600 mt-2">
                    ※実際のメールアドレスに変更してください
                </p>
            </div>

            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-3">メールに記載いただく内容</h3>
                <ul class="list-disc list-inside ml-4 space-y-2">
                    <li>お名前（ハンドルネーム可）</li>
                    <li>メールアドレス</li>
                    <li>お問い合わせ内容（できるだけ詳しくお書きください）</li>
                    <li>該当するページのURL（不具合報告の場合）</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4 text-blue-700">お問い合わせの種類</h2>
        <div class="space-y-3 text-gray-700">
            <p>以下のようなお問い合わせを受け付けております：</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <h3 class="font-semibold text-green-800 mb-2">✓ 内容に関するお問い合わせ</h3>
                    <ul class="text-sm space-y-1">
                        <li>・掲載内容の誤りや修正依頼</li>
                        <li>・情報の追加リクエスト</li>
                        <li>・引用元や出典に関する質問</li>
                    </ul>
                </div>
                
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="font-semibold text-blue-800 mb-2">✓ サイト機能に関するお問い合わせ</h3>
                    <ul class="text-sm space-y-1">
                        <li>・不具合の報告</li>
                        <li>・使い方に関する質問</li>
                        <li>・新機能のご要望</li>
                    </ul>
                </div>
                
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                    <h3 class="font-semibold text-purple-800 mb-2">✓ 著作権に関するお問い合わせ</h3>
                    <ul class="text-sm space-y-1">
                        <li>・著作権侵害の申し立て</li>
                        <li>・引用許可に関する質問</li>
                        <li>・削除依頼</li>
                    </ul>
                </div>
                
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                    <h3 class="font-semibold text-orange-800 mb-2">✓ その他</h3>
                    <ul class="text-sm space-y-1">
                        <li>・広告掲載に関するお問い合わせ</li>
                        <li>・提携に関するご相談</li>
                        <li>・その他ご意見・ご感想</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4 text-blue-700">ご回答までの期間</h2>
        <div class="space-y-3 text-gray-700">
            <p>お問い合わせをいただいてから、原則として3営業日以内にご返信いたします。</p>
            <p class="text-sm text-gray-600">
                ※ただし、内容によってはお時間をいただく場合や、ご回答できない場合もございます。あらかじめご了承ください。
            </p>
        </div>
    </section>

    <section class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4 text-blue-700">個人情報の取り扱い</h2>
        <div class="space-y-3 text-gray-700">
            <p>お問い合わせの際にいただいた個人情報は、お問い合わせへの対応のみに使用し、適切に管理いたします。</p>
            <p>詳しくは、<a href="{{ route('privacy') }}" class="text-blue-600 hover:underline">プライバシーポリシー</a>をご確認ください。</p>
        </div>
    </section>

    <section class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-4 text-blue-700">よくある質問</h2>
        <div class="space-y-4">
            <details class="bg-gray-50 rounded-lg p-4">
                <summary class="font-semibold cursor-pointer text-gray-800 hover:text-blue-700">
                    Q. 名言を引用してもいいですか？
                </summary>
                <div class="mt-3 text-gray-700 text-sm">
                    <p>A. 個人的な利用や、適切な引用の範囲内であれば問題ありません。商業利用や大規模な転載をお考えの場合は、お問い合わせください。</p>
                </div>
            </details>

            <details class="bg-gray-50 rounded-lg p-4">
                <summary class="font-semibold cursor-pointer text-gray-800 hover:text-blue-700">
                    Q. 掲載されている情報に誤りがあります
                </summary>
                <div class="mt-3 text-gray-700 text-sm">
                    <p>A. 誤りを見つけられた場合は、該当ページのURLと修正内容を明記の上、お問い合わせください。速やかに確認・修正いたします。</p>
                </div>
            </details>

            <details class="bg-gray-50 rounded-lg p-4">
                <summary class="font-semibold cursor-pointer text-gray-800 hover:text-blue-700">
                    Q. 追加してほしい名言があります
                </summary>
                <div class="mt-3 text-gray-700 text-sm">
                    <p>A. リクエストは歓迎いたします。著者名、名言の内容、出典などの情報を添えてお問い合わせください。</p>
                </div>
            </details>

            <details class="bg-gray-50 rounded-lg p-4">
                <summary class="font-semibold cursor-pointer text-gray-800 hover:text-blue-700">
                    Q. スマートフォンで表示が崩れます
                </summary>
                <div class="mt-3 text-gray-700 text-sm">
                    <p>A. お使いのデバイス、ブラウザ、該当ページのURLを記載の上、お問い合わせください。改善に努めます。</p>
                </div>
            </details>
        </div>
    </section>

    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-yellow-800 mb-2">⚠️ ご注意</h3>
        <ul class="text-sm text-gray-700 space-y-1">
            <li>・お問い合わせの内容によっては、ご回答できない場合がございます</li>
            <li>・営業や勧誘目的のお問い合わせはご遠慮ください</li>
            <li>・土日祝日のお問い合わせは、翌営業日以降の対応となります</li>
        </ul>
    </div>

    <div class="text-center bg-blue-100 rounded-lg p-6">
        <p class="text-gray-700 mb-4">
            皆様からのお問い合わせをお待ちしております。<br>
            より良いサイトづくりのため、ご協力をお願いいたします。
        </p>
    </div>
</div>
@endsection
