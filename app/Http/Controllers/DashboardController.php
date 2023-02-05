<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Session;
use App\Models\PageView;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'website' => auth()->user()->currentWebsite
        ]);
    }

    public function overview(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $sessions = Session::where('website_id', $website->id)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $pageViews = PageView::where('website_id', $website->id)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return response()->json([
            'sessions' => $sessions,
            'pageViews' => $pageViews
        ]);
    }

    public function browsers(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $browers = Session::where('website_id', $website->id)
            ->select('browser as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($browers);
    }

    public function os(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $os = Session::where('website_id', $website->id)
            ->select('os as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('os')
            ->groupBy('os')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($os);
    }

    public function languages(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $language = Session::where('website_id', $website->id)
            ->select('language as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('language')
            ->groupBy('language')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($language);
    }

    public function screens(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $screens = Session::where('website_id', $website->id)
            ->select('screen as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('screen')
            ->groupBy('screen')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($screens);
    }

    public function devices(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $devices = Session::where('website_id', $website->id)
            ->select('device as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('device')
            ->groupBy('device')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($devices);
    }

    public function countries(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $countries = Session::where('website_id', $website->id)
            ->select('country as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($countries);
    }

    public function regions(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $regions = Session::where('website_id', $website->id)
            ->select('region as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('region')
            ->groupBy('region')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();


        return response()->json($regions);
    }

    public function cities(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $cities = Session::where('website_id', $website->id)
            ->select('city as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($cities);
    }

    public function pages(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $pages = PageView::where('website_id', $website->id)
            ->select('url', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('url')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();

        return response()->json($pages);
    }

    public function entryPages(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $pages = PageView::where('website_id', $website->id)
            ->select('url', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('url')
            ->orderBy('total', 'desc')
            ->get();

        return response()->json($pages);
    }

    public function exitPages(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $pages = PageView::where('website_id', $website->id)
            ->select('url', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('url')
            ->orderBy('total', 'desc')
            ->get();

        return response()->json($pages);
    }

    public function referrers(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $referrers = PageView::where('website_id', $website->id)
            ->select('referrer as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('referrer')
            ->groupBy('referrer')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($referrers);
    }

    public function utmSources(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $utmSources = Session::where('website_id', $website->id)
            ->select('utm_source as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_source')
            ->groupBy('utm_source')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($utmSources);
    }

    public function utmMediums(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $utmMediums = Session::where('website_id', $website->id)
            ->select('utm_medium as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_medium')
            ->groupBy('utm_medium')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($utmMediums);
    }

    public function utmCampaigns(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $utmCampaigns = Session::where('website_id', $website->id)
            ->select('utm_campaign as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_campaign')
            ->groupBy('utm_campaign')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($utmCampaigns);
    }

    public function utmContents(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $utmContents = Session::where('website_id', $website->id)
            ->select('utm_content as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_content')
            ->groupBy('utm_content')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($utmContents);
    }

    public function utmTerms(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $website = auth()->user()->currentWebsite;

        $utmTerms = Session::where('website_id', $website->id)
            ->select('utm_term as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_term')
            ->groupBy('utm_term')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();

        return response()->json($utmTerms);
    }

    public function loadChart(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $website = auth()->user()->currentWebsite;

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $pointInterval = 60 * 1000 * 60 * 24; // 1day

        $data = [
            [
                'name' => 'Installation & Developers',
                'data' => [43934, 48656, 65165, 81827, 112143, 142383, 171533, 165174, 155157, 161454, 154610]
            ]
        ];

        return response()->json([
            'data' => $data,
            'pointStart' => $start->getTimestampMs(),
            'pointInterval' => $pointInterval,
            'min' => $start->getTimestampMs(),
            'max' => $end->getTimestampMs(),
            'color' =>  '#000000',
            'fillOpacity' => 0.1,
        ]);
    }
}
