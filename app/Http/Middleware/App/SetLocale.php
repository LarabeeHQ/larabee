<?php

namespace App\Http\Middleware\App;

use Closure;
use Illuminate\Support\Facades\Auth;


class SetLocale
{
    public function handle($request, Closure $next)
    {

        // check if user is logged in
        if(Auth::check()) {

            // set the app locale
            app()->setLocale($request->user()->language->locale);
        }

        return $next($request);
    }
}
