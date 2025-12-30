{{-- resources/views/pages/terms.blade.php --}}
@extends('layouts.app')

@section('title', '利用規約 - 名言・格言・ことわざ・百人一首サイト')

@section('meta_description', '当サイトの利用規約についてご説明します。サービスの利用条件、禁止事項、免責事項などについて。')

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- パンくずリスト --}}
        @include('components.breadcrumbs', [
            'breadcrumbs' => [
                ['name' => 'ホーム', 'url' => route('home')],
                ['name' => '利用規約']
            ]
        ])

        <h1 class="text-3xl font-bold mb-6">利用規約</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <p class="mb-4 text-gray-700">
                この利用規約（以下「本規約」）は、名言・格言・ことわざ・百人一首サイト（以下「当サイト」）が提供するサービスの利用条件を定めるものです。ユーザーの皆様には、本規約に従って当サイトをご利用いただきます。
            </p>
        </div>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第1条（適用）</h2>
            <div class="space-y-3 text-gray-700">
                <ol class="list-decimal list-inside ml-4 space-y-2">
                    <li>本規約は、ユーザーと当サイトとの間の当サイトの利用に関わる一切の関係に適用されます。</li>
                    <li>当サイトが当サイト上で掲載する利用に関するルールは、本規約の一部を構成するものとします。</li>
                    <li>本規約の内容と、前項のルールその他の本規約外における当サイトの説明等が異なる場合は、本規約の規定が優先して適用されるものとします。</li>
                </ol>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第2条（利用資格）</h2>
            <div class="space-y-3 text-gray-700">
                <p>ユーザーは、本規約に同意の上、当サイトを利用することができます。本規約に同意いただけない場合は、当サイトをご利用いただけません。</p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第3条（サービスの内容）</h2>
            <div class="space-y-3 text-gray-700">
                <p>当サイトは、以下のコンテンツを提供します：</p>
                <ul class="list-disc list-inside ml-4 space-y-2">
                    <li>偉人の名言・格言の閲覧</li>
                    <li>ことわざ・四字熟語・慣用句の閲覧</li>
                    <li>百人一首の閲覧</li>
                    <li>各種検索機能</li>
                    <li>その他関連情報の提供</li>
                </ul>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第4条（知的財産権）</h2>
            <div class="space-y-3 text-gray-700">
                <ol class="list-decimal list-inside ml-4 space-y-2">
                    <li>当サイトに掲載されているコンテンツ（文章、画像、デザイン等）の著作権は、当サイト運営者または権利を有する第三者に帰属します。</li>
                    <li>ユーザーは、当サイトのコンテンツを、私的使用の範囲を超えて、無断で複製、転載、配布、公開等することはできません。</li>
                    <li>名言・格言・ことわざ・四字熟語・百人一首等の引用元については、可能な限り出典を明記しています。</li>
                </ol>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第5条（禁止事項）</h2>
            <div class="space-y-3 text-gray-700">
                <p>ユーザーは、当サイトの利用にあたり、以下の行為をしてはなりません：</p>
                <ul class="list-disc list-inside ml-4 space-y-2">
                    <li>法令または公序良俗に違反する行為</li>
                    <li>犯罪行為に関連する行為</li>
                    <li>当サイトのサーバーまたはネットワークの機能を破壊したり、妨害したりする行為</li>
                    <li>当サイトの運営を妨害するおそれのある行為</li>
                    <li>他のユーザーに関する個人情報等を収集または蓄積する行為</li>
                    <li>不正アクセスをし、またはこれを試みる行為</li>
                    <li>他のユーザーに成りすます行為</li>
                    <li>当サイトが許諾しない方法での商業的利用行為</li>
                    <li>当サイトのサービスに関連して、反社会的勢力に対して直接または間接に利益を供与する行為</li>
                    <li>その他、当サイトが不適切と判断する行為</li>
                </ul>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第6条（サービスの提供の停止等）</h2>
            <div class="space-y-3 text-gray-700">
                <ol class="list-decimal list-inside ml-4 space-y-2">
                    <li>当サイトは、以下のいずれかの事由があると判断した場合、ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができます：
                        <ul class="list-disc list-inside ml-8 mt-2 space-y-1">
                            <li>サービスにかかるコンピュータシステムの保守点検または更新を行う場合</li>
                            <li>地震、落雷、火災、停電または天災などの不可抗力により、サービスの提供が困難となった場合</li>
                            <li>コンピュータまたは通信回線等が事故により停止した場合</li>
                            <li>その他、当サイトがサービスの提供が困難と判断した場合</li>
                        </ul>
                    </li>
                    <li>当サイトは、サービスの提供の停止または中断により、ユーザーまたは第三者が被ったいかなる不利益または損害についても、一切の責任を負わないものとします。</li>
                </ol>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第7条（免責事項）</h2>
            <div class="space-y-3 text-gray-700">
                <ol class="list-decimal list-inside ml-4 space-y-2">
                    <li>当サイトは、サービスの内容、情報の正確性、有用性、完全性、適法性、最新性等について、明示的にも黙示的にも何ら保証しません。</li>
                    <li>当サイトは、ユーザーがサービスを利用したことにより生じた損害について、一切の責任を負いません。</li>
                    <li>当サイトから他のウェブサイトへのリンクまたは他のウェブサイトから当サイトへのリンクが提供されている場合でも、当サイトは、他のウェブサイトの内容について責任を負いません。</li>
                    <li>当サイトに掲載された名言・格言等の解釈や利用により生じたいかなる損害についても、当サイトは責任を負いません。</li>
                </ol>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第8条（サービス内容の変更等）</h2>
            <div class="space-y-3 text-gray-700">
                <p>当サイトは、ユーザーへの事前の告知をもって、サービスの内容を変更、追加または廃止することがあり、ユーザーはこれを承諾するものとします。</p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第9条（利用規約の変更）</h2>
            <div class="space-y-3 text-gray-700">
                <ol class="list-decimal list-inside ml-4 space-y-2">
                    <li>当サイトは、必要と判断した場合には、ユーザーに通知することなくいつでも本規約を変更することができます。</li>
                    <li>変更後の本規約は、当サイトに掲載した時点から効力を生じるものとします。</li>
                    <li>本規約の変更後、サービスの利用を開始した場合には、変更後の規約に同意したものとみなします。</li>
                </ol>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-700">第10条（準拠法・管轄裁判所）</h2>
            <div class="space-y-3 text-gray-700">
                <ol class="list-decimal list-inside ml-4 space-y-2">
                    <li>本規約の解釈にあたっては、日本法を準拠法とします。</li>
                    <li>サービスに関して紛争が生じた場合には、当サイトの運営者の所在地を管轄する裁判所を専属的合意管轄とします。</li>
                </ol>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6 mb-6">

                               <h2 class="text-2xl font-semibold mb-4 text-blue-700">第11条（お問い合わせ）</h2>
            <div class="space-y-3 text-gray-700">
                <p>本規約に関するお問い合わせは、<a href="{{ route('contact') }}" class="text-blue-600 hover:underline">お問い合わせページ</a>からご連絡ください。</p>
            </div>
        </section>

        <div class="bg-gray-100 rounded-lg p-4 text-right text-gray-600">
            <p>制定日：{{ date('Y年m月d日') }}</p>
        </div>
    </div>
@endsection
