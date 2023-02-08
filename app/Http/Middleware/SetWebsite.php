<?php

namespace App\Http\Middleware;

use Request, Auth, Closure, Cache, App;

class SetWebsite
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->websites->count() == 0 && $request->segment(1) != 'websites' && $request->segment(2) != 'create') {
            return redirect(route('websites.create'));
        }

        return $next($request);
    }
}
