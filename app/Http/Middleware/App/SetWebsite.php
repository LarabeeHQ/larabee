<?php

namespace App\Http\Middleware\App;

use Request, Auth, Closure, Cache, App;

class SetWebsite
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $websites = $user->websites;

        // if user has no website, redirect to create website page
        if ($websites->count() == 0 && $request->segment(1) != 'websites' && $request->segment(2) != 'create') {
            return redirect(route('websites.create'));
        }

        // if user has any website,but no current website, set first website as current website
        if ($websites->count() >= 1 && !$user->current_website_id) {
            $website = $websites->first();

            $user->update([
                'current_website_id' => $website->id
            ]);

        }

        return $next($request);
    }
}
