<?php

namespace App\Http\Controllers\Api;

use App\Jobs\ProcessColletectedData;
use App\Http\Requests\CollectRequest;

use App\Models\Website;

use Illuminate\Support\Facades\Cache;

class CollectController extends Controller
{
    public function store(CollectRequest $request)
    {
        $website = Cache::remember("website:{$request->website_id}", now()->addMinutes(5), function () use ($request) {
            return Website::where('id', $request->website_id)->first();
        });

        if(!$website) {
            return response()->json(null, 404);
        }

        $data = [
            'ip' => $request->ip(),
            'user_agent' => $request->user_agent,
            'hostname' => $request->hostname,
            'referrer' => $request->referrer,
            'language' => $request->language,
            'screen' => $request->screen,
            'device' => $request->device,
            'os' => $request->os,
            'browser' => $request->browser,
            'url' => $request->url
        ];

        ProcessColletectedData::dispatch($data, $website);

        return response()->json(null, 202);
    }
}
