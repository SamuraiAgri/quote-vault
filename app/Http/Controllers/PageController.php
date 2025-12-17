<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 静的ページを管理するコントローラー
 * 単一責任の原則：静的ページの表示のみを担当
 */
class PageController extends Controller
{
    /**
     * プライバシーポリシーページを表示
     */
    public function privacy()
    {
        return view('pages.privacy', [
            'title' => 'プライバシーポリシー'
        ]);
    }

    /**
     * 利用規約ページを表示
     */
    public function terms()
    {
        return view('pages.terms', [
            'title' => '利用規約'
        ]);
    }

    /**
     * お問い合わせページを表示
     */
    public function contact()
    {
        return view('pages.contact', [
            'title' => 'お問い合わせ'
        ]);
    }
}
