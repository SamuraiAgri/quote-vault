<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * セキュリティヘッダーを追加するミドルウェア
 * XSS、クリックジャッキング等の攻撃を防御
 */
class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // XSS Protection
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Content Type Sniffing Prevention
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Clickjacking Protection
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // Content Security Policy (本番環境用、必要に応じて調整)
        if (app()->environment('production')) {
            $csp = "default-src 'self'; " .
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com https://pagead2.googlesyndication.com https://googleads.g.doubleclick.net; " .
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
                "font-src 'self' https://fonts.gstatic.com; " .
                "img-src 'self' data: https:; " .
                "frame-src https://googleads.g.doubleclick.net https://tpc.googlesyndication.com; " .
                "connect-src 'self' https://www.google-analytics.com https://ep1.adtrafficquality.google;";
            $response->headers->set('Content-Security-Policy', $csp);
        }

        return $response;
    }
}
