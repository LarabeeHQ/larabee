<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;

use App\Jobs\ProcessColletectedData;

use Illuminate\Http\Request;
use Browser;

use App\Models\User;
use App\Models\Website;
use App\Models\Session;
use App\Models\PageView;

use Illuminate\Support\Facades\Cache;

class CollectController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website' => ['required', 'uuid'],
            'event' => ['required', 'string'],
            'hostname' => ['required', 'string'],
            'referrer' => ['nullable', 'url'],
            'language' => ['nullable', 'string'],
            'screen' => ['required', 'string'],
            'url' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'ip' => $request->ip(),
            'user_agent' => $request->header('user-agent'),
            'website_id' => $request->website,
            'event' => $request->event,
            'hostname' => $request->hostname,
            'referrer' => $request->referrer,
            'language' => $request->language,
            'screen' => $request->screen,
            'url' => $request->url
        ];

        ProcessColletectedData::dispatch($data);
        // ProcessColletectedData::dispatchAfterResponse($data);

        return response()->json(null, 202);
    }
}
