<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Session;
use App\Models\Website;
use App\Models\PageView;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = auth()->user()->websites;
        return Inertia::render('Website/Index', [
            'websites' => $websites,
        ]);
    }

    public function create()
    {
        return Inertia::render('Website/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'domain' => 'required|url',
        ]);

        // get auth user
        $user = auth()->user();

        // website
        $website = new Website;
        $website->name = $request->name;
        $website->domain = $request->domain;
        $website->public = false;
        $website->save();

        // attach user to website
        $user->websites()->attach($website->id, [
            'role' => User::ROLE_OWNER,
        ]);

        $user->forceFill([
            'current_website_id' => $website->id,
        ])->save();

        // change website
        $user->switchWebsite($website);

        return redirect(route('websites.index'));
    }

    public function show($id)
    {
        // get user
        $user = auth()->user();

        // get website
        $website = Website::where('id', $id)->firstOrFail();

        // check if user belongs to website
        if (!$user->belongsToWebsite($website)) {
            abort(404);
        }

        return Inertia::render('Website/Show', [
            'website' => $website
        ]);
    }

    public function loadData($id, Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $website = Website::where('id', $id)->firstOrFail();

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();


        $sessions = Session::where('website_id', $id)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $pageViews = PageView::where('website_id', $id)
            ->whereBetween('created_at', [$start, $end])
            ->get();


        $pages = PageView::where('website_id', $id)
            ->select('url', \DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('url')
            ->orderBy('total', 'desc')
            ->get();

        $referrer = PageView::where('website_id', $id)
            ->select('referrer', \DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$start, $end])
            ->where('referrer', 'NOT ILIKE', "%[$website->id}%" )
            ->groupBy('referrer')
            ->orderBy('total', 'desc')
            ->get();


        $data = [
            'sessions' => $sessions->count(),
            'bounce_rate' => $sessions->count() > 0 ? ($sessions->count() / $sessions->count()) * 100 : 0,

            //value={uniques.value ? (num / uniques.value) * 100 : 0}
            'avg_session_duration' => 0,
            'page_views' => $pageViews->count(),

            'pages' => $pages,
            'referrer' => $referrer,

            'devices' => [
                'desktop' => 0,
                'mobile' => 0,
                'tablet' => 0,
            ],

            'browser' => [
                'chrome' => 0,
                'firefox' => 0,
                'safari' => 0,
                'edge' => 0,
                'opera' => 0,
                'other' => 0,
            ],

            'os' => [
                'windows' => 0,
                'mac' => 0,
                'linux' => 0,
                'ios' => 0,
                'android' => 0,
                'other' => 0,
            ],
        ];

        return response()->json($data);
    }

    public function setCurrentWebsite(Request $request)
    {
        $website = Website::findOrFail($request->website_id);

        if (!$request->user()->switchWebsite($website)) {
            abort(403);
        }

        return Inertia::location(route('inbox.index'));
    }
}
