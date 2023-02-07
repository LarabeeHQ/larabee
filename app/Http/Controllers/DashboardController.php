<?php

namespace App\Http\Controllers;

use App\Repositories\WebsiteRepository;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Session;
use App\Models\PageView;

class DashboardController extends Controller
{
    /**
     * The website repository implementation.
     *
     * @var WebsiteRepository
     */
    protected $website;

    public function __construct(WebsiteRepository $website)
    {
        $this->website = $website;
    }

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

        $website = auth()->user()->currentWebsite;

        $startDate = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay();

        $diffInDays = $startDate->diffInDays($endDate);

        $prevStartDate = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay()->subDays($diffInDays)->toDateTimeString();
        $prevEndDate = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay()->subDays($diffInDays)->toDateTimeString();

        $data = $this->website->overviewStats($website->id, $startDate, $endDate, $prevStartDate, $prevEndDate);


        return response()->json($data);
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

        $browers = $this->website->browserStats($website->id, $start, $end);

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

        $os = $this->website->osStats($website->id, $start, $end);

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

        $languages = $this->website->languageStats($website->id, $start, $end);

        return response()->json($languages);
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

        $screens = $this->website->screenStats($website->id, $start, $end);

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

        $devices = $this->website->deviceStats($website->id, $start, $end);

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

        $countries = $this->website->countryStats($website->id, $start, $end);

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

        $regions = $this->website->regionStats($website->id, $start, $end);

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

        $cities = $this->website->cityStats($website->id, $start, $end);

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

        $pages = $this->website->pageStats($website->id, $start, $end);

        return response()->json($pages);
    }

    public function entryPages(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay()->toDateTimeString();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay()->toDateTimeString();

        $website = auth()->user()->currentWebsite;

        $pages = $this->website->entryPageStats($website->id, $start, $end);

        return response()->json($pages);
    }

    public function exitPages(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
        ]);

        $start = Carbon::createFromFormat('Y-m-d', $request->start, auth()->user()->timezone->value)->setTimezone('UTC')->startOfDay()->toDateTimeString();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, auth()->user()->timezone->value)->setTimezone('UTC')->endOfDay()->toDateTimeString();

        $website = auth()->user()->currentWebsite;

        $pages = $this->website->exitPageStats($website->id, $start, $end);

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

        $referrers = $this->website->referrerStats($website->id, $start, $end);

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

        $utmSources = $this->website->utmSourceStats($website->id, $start, $end);

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

        $utmMediums = $this->website->utmMediumStats($website->id, $start, $end);

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

        $utmCampaigns = $this->website->utmCampaignStats($website->id, $start, $end);

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

        $utmContents = $this->website->utmContentStats($website->id, $start, $end);

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

        $utmTerms = $this->website->utmTermStats($website->id, $start, $end);

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
