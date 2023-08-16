<?php

namespace App\Http\Controllers\Api;

use App\Jobs\ProcessUserData;

use Illuminate\Http\Request;
use App\Models\Website;

use Illuminate\Support\Facades\Cache;

class SessionController extends Controller
{
    public function update(Request $request)
    {
        $website = Cache::remember("website:{$request->website_id}", now()->addMinutes(5), function () use ($request) {
            return Website::where('id', $request->website_id)->first();
        });

        if (!$website) {
            return response()->json(null, 404);
        }

        $data = [
            'ip' => $request->ip(),
            'user_agent' => $request->header('user-agent'),
            'hostname' => $request->hostname,
            'user' => $request->user,
        ];

        ProcessUserData::dispatch($data, $website);

        return response()->json(null, 202);
    }
}
