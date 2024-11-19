<?php

namespace App\Http\Controllers\App;

use App\Services\CalculateStat;

use App\Enums\UserRole;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Website;

class AnalyticsController extends Controller
{
    public function __construct(
        public CalculateStat $stat
    ) {}

    public function index()
    {
        $website = auth()->user()->currentWebsite->loadCount('sessions');

        return Inertia::render('App/Website/Show/Home/Index', [
            'website' => $website
        ]);
    }

    public function statistics(Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
            'start_previous' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end_previous' => ['required', 'max:255', 'date_format:Y-m-d'],
            'metric' => ['required', 'max:255', Rule::in(Website::METRICS)],
            'group' => ['required', 'max:255', 'in:minute,hour,day,month'],
            'key' => ['required', 'in:today,yesterday,last_7_days,last_30_days,this_month,last_month,this_year,last_12_months'],
            'timezone' => ['required', 'max:255'],
        ]);

        $website = auth()->user()->currentWebsite;

        // check if website is public or user is logged in
        if (!auth()->check() && !$website->public) {
            abort(404);
        }

        // validate if user belongs to website
        if (auth()->check()) {
            auth()->user()->belongsToWebsite($website);
        }

        $timezone = $request->timezone;

        $start = Carbon::createFromFormat('Y-m-d', $request->start, $timezone)->startOfDay()->setTimezone('UTC');
        $end = Carbon::createFromFormat('Y-m-d', $request->end, $timezone)->endOfDay()->setTimezone('UTC');

        $startPrevious = Carbon::createFromFormat('Y-m-d', $request->start_previous, $timezone)->startOfDay()->setTimezone('UTC');
        $endPrevious = Carbon::createFromFormat('Y-m-d', $request->end_previous, $timezone)->endOfDay()->setTimezone('UTC');

        switch ($request->metric) {
            case 'unique-users':
                $data = $this->stat->uniqueUsers($website, $timezone, $start, $end, $startPrevious, $endPrevious, $request->group);
                break;

            case 'page-views':
                $data = $this->stat->pageViews($website, $timezone, $start, $end, $startPrevious, $endPrevious, $request->group);
                break;

            case 'online':
                $data = $this->stat->online($website);
                break;

            case 'pages':
                $data = $this->stat->pageStats($website->id, $start, $end);
                break;

            case 'entry-pages':
                $data = $this->stat->entryPageStats($website->id, $start, $end);
                break;

            case 'exit-pages':
                $data = $this->stat->exitPageStats($website->id, $start, $end);
                break;

            case 'referrers':
                $data = $this->stat->referrerStats($website->id, $start, $end);
                break;

            case 'utm-sources':
                $data = $this->stat->utmSourceStats($website->id, $start, $end);
                break;

            case 'utm-mediums':
                $data = $this->stat->utmMediumStats($website->id, $start, $end);
                break;

            case 'utm-campaigns':
                $data = $this->stat->utmCampaignStats($website->id, $start, $end);
                break;

            case 'utm-contents':
                $data = $this->stat->utmContentStats($website->id, $start, $end);
                break;

            case 'utm-terms':
                $data = $this->stat->utmTermStats($website->id, $start, $end);
                break;

            case 'events':
                $data = $this->stat->events($website->id, $start, $end);
                break;

            case 'browsers':
                $data = $this->stat->browserStats($website->id, $start, $end);
                break;

            case 'os':
                $data = $this->stat->osStats($website->id, $start, $end);
                break;

            case 'devices':
                $data = $this->stat->deviceStats($website->id, $start, $end);
                break;

            case 'screens':
                $data = $this->stat->screenStats($website->id, $start, $end);
                break;

            case 'languages':
                $data = $this->stat->languageStats($website->id, $start, $end);
                break;

            case 'countries':
                $data = $this->stat->countryStats($website->id, $start, $end);
                break;

            case 'regions':
                $data = $this->stat->regionStats($website->id, $start, $end);
                break;

            case 'cities':
                $data = $this->stat->cityStats($website->id, $start, $end);
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);
    }
}
