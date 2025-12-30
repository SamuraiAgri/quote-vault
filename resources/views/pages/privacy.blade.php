{{-- resources/views/pages/privacy.blade.php --}}
@extends('layouts.app')

@section('title', 'プライバシーポリシー - 名言・格言・ことわざ・百人一首サイト')

@section('meta_description', '当サイトのプライバシーポリシーについてご説明します。個人情報の取り扱い、Cookie、Google AdSense、アクセス解析ツールの使用について。')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', [
            'breadcrumbs' => [
                ['name' => 'ホーム', 'url' => route('home')],
                ['name' => 'プライバシーポリシー']
            ]
        ])

        <h1 class="text-3xl font-bold mb-6">プライバシーポリシー</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <p class="mb-4 text-gray-700">
                名言・格言・ことわざ・百人一首サイト（以下「当サイト」）は、ユーザーのプライバシーを尊重し、個人情報の保護に努めています。本プライバシーポリシーでは、当サイトにおける個人情報の取り扱いについて説明します。
            </p>
        </div>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">1. 収集する情報</h2>
            <div class="space-y-3 text-gray-700">
                <p>当サイトでは、以下の情報を収集する場合があります：</p>
                <ul class="list-disc list-inside ml-4 space-y-2">
                    <li>アクセスログ（IPアドレス、ブラウザの種類、参照元など）</li>
                    <li>Cookie及び類似技術による情報</li>
                    <li>お問い合わせフォームにご入力いただいた情報</li>
                </ul>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">2. 情報の利用目的</h2>
            <div class="space-y-3 text-gray-700">
                <p>収集した情報は以下の目的で利用します：</p>
                <ul class="list-disc list-inside ml-4 space-y-2">
                    <li>サイトの運営・管理</li>
                    <li>サービスの改善</li>
                    <li>統計データの作成</li>
                    <li>お問い合わせへの対応</li>
                </ul>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">3. Cookieについて</h2>
            <div class="space-y-3 text-gray-700">
                <p>当サイトでは、ユーザーエクスペリエンスの向上のためにCookieを使用しています。</p>
                <p>Cookieとは、Webサイトがユーザーのコンピュータに保存する小さなテキストファイルです。ブラウザの設定でCookieを無効にすることができますが、その場合、サイトの機能が制限される可能性があります。</p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">4. Google AdSenseについて</h2>

                        <div class="space-y-3 text-gray-700">
                <p>当サイトは、広告配信サービスとしてGoogle AdSenseを使用しています。</p>
                <p>Google AdSenseは、Cookieを使用してユーザーの興味に基づいた広告を表示します。Cookieを使用することで、ユーザーが当サイトや他のサイトを訪問した際の情報に
     基                  づいて広告が表示されます。</p>
                <p>ユーザーは、Googleの広告設定ページで、パーソナライズ広告を無効にすることができます。</p>
                <p>
                    <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
                        Googleの広告設定
                    </a>
                </p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">5. アクセス解析ツールについて</h2>
            <div class="space-y-3 text-gray-700">
                <p>当サイトでは、Googleによるアクセス解析ツール「Google Analytics」を使用しています。</p>
                <p>Google Analyticsはトラフィックデータの収集のためにCookieを使用しています。このトラフィックデータは匿名で収集されており、個人を特定するもので
     は                  ありません。</p>
                <p>詳細は以下をご確認ください：</p>
                <p>
                    <a href="https://policies.google.com/technologies/partner-sites" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
                        Googleのサービスを使用するサイトやアプリから収集した情報のGoogleによる使用
                    </a>
                </p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">6. 個人情報の第三者への開示</h2>
            <div class="space-y-3 text-gray-700">
                <p>当サイトは、以下の場合を除き、個人情報を第三者に開示することはありません：</p>
                <ul class="list-disc list-inside ml-4 space-y-2">
                    <li>ユーザーの同意がある場合</li>
                    <li>法令に基づく場合</li>
                    <li>人の生命、身体または財産の保護のために必要がある場合</li>
                </ul>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">7. 免責事項</h2>
            <div class="space-y-3 text-gray-700">
                <p>当サイトのコンテンツは、可能な限り正確な情報を掲載するよう努めていますが、その正確性や安全性を保証するものではありません。</p>
                <p>当サイトに掲載された内容によって生じた損害等については、一切の責任を負いかねます。</p>
                <p>当サイトから他のサイトへのリンクは、情報提供を目的としています。リンク先のサイトの内容について、当サイトは責任を負いません。</p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">8. プライバシーポリシーの変更</h2>
            <div class="space-y-3 text-gray-700">
                <p>当サイトは、必要に応じて本プライバシーポリシーを変更することがあります。変更後のプライバシーポリシーは、本ページに掲載した時点で効力を生じるものとします。</p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">

                               <h2 class="text-2xl font-semibold mb-4 text-blue-700">9. お問い合わせ</h2>
            <div class="space-y-3 text-gray-700">
                <p>本プライバシーポリシーに関するお問い合わせは、<a href="{{ route('contact') }}" class="text-blue-600 hover:underline">お問い合わせページ</a>からご連絡ください。</p>
            </div>
        </section>

        <div class="bg-gray-100 rounded-lg p-4 text-right text-gray-600">
            <p>制定日：{{ date('Y年m月d日') }}</p>
        </div>
    </div>
@endsection
