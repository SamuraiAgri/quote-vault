<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * レスポンスキャッシュヘッダーを追加するミドルウェア
 * ブラウザキャッシュを活用してパフォーマンスを向上
 */
class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $maxAge キャッシュ期間（秒）
     * @return mixed
     */
    public function handle(Request $request, Closure $next, int $maxAge = 3600)
    {
        $response = $next($request);

        // GETリクエストのみキャッシュ
        if ($request->isMethod('GET')) {
            $response->headers->set('Cache-Control', "public, max-age={$maxAge}");
            $response->headers->set('Vary', 'Accept-Encoding');
        }

        return $response;
    }
}
