<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Proverb;
use App\Models\Hyakuninisshu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * ランダムコンテンツコントローラー
 * 「今日の名言」などのランダム表示機能を提供
 */
class RandomController extends Controller
{
    /**
     * 今日の名言を表示
     * キャッシュを使用して1日1回だけ変更
     */
    public function dailyQuote()
    {
        $dailyQuote = Cache::remember('daily_quote_' . date('Y-m-d'), 86400, function () {
            return Quote::with('author')
                        ->inRandomOrder()
                        ->first();
        });

        return view('random.daily-quote', compact('dailyQuote'));
    }

    /**
     * ランダムな名言を取得（AJAX用）
     */
    public function randomQuote()
    {
        $quote = Quote::with('author')
                      ->inRandomOrder()
                      ->first();

        if (request()->wantsJson()) {
            return response()->json([
                'id' => $quote->id,
                'text' => $quote->quote_text,
                'author' => $quote->author->name,
                'url' => route('quotes.show', $quote->id),
            ]);
        }

        return redirect()->route('quotes.show', $quote->id);
    }

    /**
     * ランダムなことわざを取得
     */
    public function randomProverb()
    {
        try {
            $proverb = Proverb::with('category')
                              ->inRandomOrder()
                              ->first();

            if (!$proverb) {
                return redirect()->route('proverbs.index');
            }

            if (request()->wantsJson()) {
                return response()->json([
                    'id' => $proverb->id,
                    'word' => $proverb->word,
                    'reading' => $proverb->reading,
                    'type' => $proverb->type,
                    'url' => route('proverbs.show', $proverb->id),
                ]);
            }

            return redirect()->route('proverbs.show', $proverb->id);
        } catch (\Exception $e) {
            return redirect()->route('proverbs.index');
        }
    }

    /**
     * ランダムな百人一首を取得
     */
    public function randomPoem()
    {
        try {
            $poem = Hyakuninisshu::with('poet')
                                 ->inRandomOrder()
                                 ->first();

            if (!$poem) {
                return redirect()->route('hyakuninisshu.index');
            }

            if (request()->wantsJson()) {
                return response()->json([
                    'id' => $poem->id,
                    'number' => $poem->number,
                    'upper_phrase' => $poem->upper_phrase,
                    'lower_phrase' => $poem->lower_phrase,
                    'poet' => $poem->poet->name,
                    'url' => route('hyakuninisshu.show', $poem->id),
                ]);
            }

            return redirect()->route('hyakuninisshu.show', $poem->id);
        } catch (\Exception $e) {
            return redirect()->route('hyakuninisshu.index');
        }
    }

    /**
     * 今日のコンテンツをまとめて表示
     */
    public function dailyAll()
    {
        $today = date('Y-m-d');

        $dailyQuote = Cache::remember('daily_quote_' . $today, 86400, function () {
            return Quote::with('author')->inRandomOrder()->first();
        });

        $dailyProverb = Cache::remember('daily_proverb_' . $today, 86400, function () {
            try {
                return Proverb::with('category')->inRandomOrder()->first();
            } catch (\Exception $e) {
                return null;
            }
        });

        $dailyPoem = Cache::remember('daily_poem_' . $today, 86400, function () {
            try {
                return Hyakuninisshu::with('poet')->inRandomOrder()->first();
            } catch (\Exception $e) {
                return null;
            }
        });

        return view('random.daily-all', compact('dailyQuote', 'dailyProverb', 'dailyPoem'));
    }
}
