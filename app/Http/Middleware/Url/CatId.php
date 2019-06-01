<?php

namespace App\Http\Middleware\Url;

use Closure;

class CatId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url=explode('.',$request->id);
        $request->id=$url[0];
        return $next($request);
    }
}
