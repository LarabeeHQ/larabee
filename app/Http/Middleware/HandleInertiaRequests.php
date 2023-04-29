<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => function () use ($request) {
                    if (!$request->user()) {
                        return;
                    }

                    return array_merge($request->user()->toArray(), array_filter([
                        'current_website' => $request->user()->current_website_id ? $request->user()->currentWebsite : null,
                        'websites' => $request->user()->websites,
                        'is_trial' => $request->user()->onTrial(),
                        'plan' => $request->user()->plan,
                    ]));
                },
            ],
            'plans' => config('plans.index'),
            'flash' => $request->session()->get('flash', []),
            'env' => config('app.env'),
            'locale' => app()->getLocale(),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
