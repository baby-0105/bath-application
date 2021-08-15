<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthSns
{
    /**
     * SNS認証ユーザーなら、404エラー
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset(auth()->user()->sns_id)) {
            abort(404);
        }
        return $next($request);
    }
}
