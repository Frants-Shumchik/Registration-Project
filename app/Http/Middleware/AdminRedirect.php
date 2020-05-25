<?php

namespace App\Http\Middleware;

use Closure;

class AdminRedirect
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role_id === 1) {
            return redirect('/admin/tests');
        }
        return $next($request);
    }
}
