<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Proverb;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * 特集一覧ページ
     */
    public function index()
    {
        $features = $this->getFeatureList();
        return view('features.index', compact('features'));
    }

    /**
     * 仕事で使える名言
     */
    public function work()
    {
        // 仕事・ビジネス関連のカテゴリから取得
        $quotes = Quote::whereHas('category', function ($query) {
            $query->where('name', 'like', '%仕事%')
                ->orWhere('name', 'like', '%ビジネス%')
                ->orWhere('name', 'like', '%成功%')
                ->orWhere('name', 'like', '%努力%');
        })
            ->with(['author', 'category'])
            ->inRandomOrder()
            ->limit(20)
            ->get();

        // 足りなければ人気の名言から補完
        if ($quotes->count() < 10) {
            $additionalQuotes = Quote::with(['author', 'category'])
                ->orderBy('access_count', 'desc')
                ->limit(20 - $quotes->count())
                ->get();
            $quotes = $quotes->merge($additionalQuotes);
        }

        $feature = [
            'title' => '仕事で使える名言10選',
            'description' => 'ビジネスシーンで心に響く、モチベーションを高める名言を厳選しました。プレゼン、朝礼、自己啓発にぜひご活用ください。',
            'slug' => 'work',
            'icon' => '💼',
        ];

        return view('features.show', compact('quotes', 'feature'));
    }

    /**
     * 恋愛に効く名言
     */
    public function love()
    {
        $quotes = Quote::whereHas('category', function ($query) {
            $query->where('name', 'like', '%恋愛%')
                ->orWhere('name', 'like', '%愛%')
                ->orWhere('name', 'like', '%人間関係%');
        })
            ->with(['author', 'category'])
            ->inRandomOrder()
            ->limit(20)
            ->get();

        if ($quotes->count() < 10) {
            $additionalQuotes = Quote::with(['author', 'category'])
                ->orderBy('access_count', 'desc')
                ->limit(20 - $quotes->count())
                ->get();
            $quotes = $quotes->merge($additionalQuotes);
        }

        $feature = [
            'title' => '恋愛に効く名言集',
            'description' => '恋に悩むあなたへ。片思い、失恋、幸せな恋愛のヒントとなる名言を集めました。',
            'slug' => 'love',
            'icon' => '💕',
        ];

        return view('features.show', compact('quotes', 'feature'));
    }

    /**
     * 落ち込んだ時に読みたい名言
     */
    public function encouragement()
    {
        $quotes = Quote::whereHas('category', function ($query) {
            $query->where('name', 'like', '%勇気%')
                ->orWhere('name', 'like', '%希望%')
                ->orWhere('name', 'like', '%前向き%')
                ->orWhere('name', 'like', '%励まし%');
        })
            ->with(['author', 'category'])
            ->inRandomOrder()
            ->limit(20)
            ->get();

        if ($quotes->count() < 10) {
            $additionalQuotes = Quote::with(['author', 'category'])
                ->orderBy('access_count', 'desc')
                ->limit(20 - $quotes->count())
                ->get();
            $quotes = $quotes->merge($additionalQuotes);
        }

        $feature = [
            'title' => '落ち込んだ時に読みたい名言',
            'description' => '辛い時、悲しい時、前に進めない時に読んでほしい、心を癒す言葉を集めました。',
            'slug' => 'encouragement',
            'icon' => '🌟',
        ];

        return view('features.show', compact('quotes', 'feature'));
    }

    /**
     * 人生を変える名言
     */
    public function life()
    {
        $quotes = Quote::whereHas('category', function ($query) {
            $query->where('name', 'like', '%人生%')
                ->orWhere('name', 'like', '%哲学%')
                ->orWhere('name', 'like', '%生き方%');
        })
            ->with(['author', 'category'])
            ->inRandomOrder()
            ->limit(20)
            ->get();

        if ($quotes->count() < 10) {
            $additionalQuotes = Quote::with(['author', 'category'])
                ->orderBy('access_count', 'desc')
                ->limit(20 - $quotes->count())
                ->get();
            $quotes = $quotes->merge($additionalQuotes);
        }

        $feature = [
            'title' => '人生を変える名言',
            'description' => '人生の転機、大切な決断の時に読みたい、深い洞察に満ちた言葉を厳選しました。',
            'slug' => 'life',
            'icon' => '🌈',
        ];

        return view('features.show', compact('quotes', 'feature'));
    }

    /**
     * 朝礼・スピーチで使える名言
     */
    public function speech()
    {
        $quotes = Quote::with(['author', 'category'])
            ->orderBy('access_count', 'desc')
            ->limit(20)
            ->get();

        $feature = [
            'title' => '朝礼・スピーチで使える名言',
            'description' => '会社の朝礼、結婚式のスピーチ、プレゼンテーションで使える印象に残る名言を紹介します。',
            'slug' => 'speech',
            'icon' => '🎤',
        ];

        return view('features.show', compact('quotes', 'feature'));
    }

    /**
     * 座右の銘にしたいことわざ
     */
    public function proverbs()
    {
        $proverbs = Proverb::with('category')
            ->orderBy('access_count', 'desc')
            ->limit(20)
            ->get();

        $feature = [
            'title' => '座右の銘にしたいことわざ・四字熟語',
            'description' => '日本に古くから伝わる知恵の結晶。人生の指針となることわざと四字熟語を厳選しました。',
            'slug' => 'proverbs',
            'icon' => '📜',
            'isProverb' => true,
        ];

        return view('features.proverbs', compact('proverbs', 'feature'));
    }

    /**
     * 特集一覧を取得
     */
    private function getFeatureList(): array
    {
        return [
            [
                'title' => '仕事で使える名言10選',
                'description' => 'ビジネスシーンでモチベーションを高める言葉',
                'slug' => 'work',
                'icon' => '💼',
                'color' => 'from-blue-500 to-indigo-600',
            ],
            [
                'title' => '恋愛に効く名言集',
                'description' => '恋に悩むあなたへ贈る言葉',
                'slug' => 'love',
                'icon' => '💕',
                'color' => 'from-pink-500 to-rose-600',
            ],
            [
                'title' => '落ち込んだ時に読みたい名言',
                'description' => '辛い時に心を癒す言葉',
                'slug' => 'encouragement',
                'icon' => '🌟',
                'color' => 'from-amber-500 to-orange-600',
            ],
            [
                'title' => '人生を変える名言',
                'description' => '深い洞察に満ちた言葉',
                'slug' => 'life',
                'icon' => '🌈',
                'color' => 'from-emerald-500 to-teal-600',
            ],
            [
                'title' => '朝礼・スピーチで使える名言',
                'description' => 'プレゼンや式典で使える印象的な言葉',
                'slug' => 'speech',
                'icon' => '🎤',
                'color' => 'from-purple-500 to-violet-600',
            ],
            [
                'title' => '座右の銘にしたいことわざ',
                'description' => '人生の指針となる日本の知恵',
                'slug' => 'proverbs',
                'icon' => '📜',
                'color' => 'from-slate-500 to-gray-600',
            ],
        ];
    }
}
