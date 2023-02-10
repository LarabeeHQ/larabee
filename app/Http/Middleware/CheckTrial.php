<?php

namespace App\Http\Middleware;

use Request, Auth, Closure, Cache, App;

class CheckTrial
{
    public function handle($request, Closure $next)
    {
        /**
         * If self hosted, skip this middleware
         */
        if(config('app.self_hosted')) {
            return $next($request);
        }

        if (!auth()->user()->onTrial() && !auth()->user()->subscribed('default')) {

            // redirect to payment page
            return redirect()->route('billing.index', ['open-modal' => true]);
        }
        else {
            return $next($request);
        }
    }
}
