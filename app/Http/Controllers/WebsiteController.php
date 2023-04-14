<?php

namespace App\Http\Controllers;

use App\Repositories\WebsiteRepository;

use Illuminate\Support\Facades\Gate;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Website;

class WebsiteController extends Controller
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

    public function create()
    {
        return Inertia::render('Website/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'domain' => 'required',
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

        session()->flash('flash.banner', 'Website created');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('websites.show', $website->id));
    }

    public function edit($id, Request $request)
    {
        $website = Website::find($id);

        return Inertia::render('Website/Edit', [
            'website' => $website
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'domain' => 'required',
        ]);

        $website = Website::find($id);

        $website->name = $request->name;
        $website->domain = $request->domain;
        $website->session_duration = $request->session_duration;
        $website->public = $request->public;
        $website->save();

        session()->flash('flash.banner', 'Website updated');
        session()->flash('flash.bannerStyle', 'success');

        return back();
    }

    public function show($id)
    {
        Gate::forUser(auth()->user())->authorize('view', auth()->user());

        $website = Website::where('id', $id)
            ->withCount('sessions')
            ->firstOrFail();

        // check if website is public or user is logged in
        if (!auth()->check() && !$website->public) {
            abort(404);
        }

        // validate if user belongs to website
        if (auth()->check()) {
            auth()->user()->belongsToWebsite($website);
        }

        return Inertia::render('Website/Show/Home/Index', [
            'website' => $website
        ]);
    }

    public function statistics($id, Request $request)
    {
        $request->validate([
            'start' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end' => ['required', 'max:255', 'date_format:Y-m-d'],
            'start_previous' => ['required', 'max:255', 'date_format:Y-m-d'],
            'end_previous' => ['required', 'max:255', 'date_format:Y-m-d'],
            'metric' => ['required', 'max:255', Rule::in(Website::METRICS)],
            'group' => ['required', 'max:255', 'in:minute,hour,day,month'],
            'key' => ['required', 'in:today,yesterday,this_month,last_month,this_year,last_12_months']
        ]);

        $website = Website::find($id);

        // check if website is public or user is logged in
        if (!auth()->check() && !$website->public) {
            abort(404);
        }

        // validate if user belongs to website
        if (auth()->check()) {
            auth()->user()->belongsToWebsite($website);
        }

        $timezone = auth()->check() ? auth()->user()->timezone->value : 'UTC';
        $start = Carbon::createFromFormat('Y-m-d', $request->start, $timezone)->setTimezone('UTC')->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end, $timezone)->setTimezone('UTC')->endOfDay();

        $startPrevious = Carbon::createFromFormat('Y-m-d', $request->start_previous, $timezone)->setTimezone('UTC')->startOfDay();
        $endPrevious = Carbon::createFromFormat('Y-m-d', $request->end_previous, $timezone)->setTimezone('UTC')->endOfDay();

        switch ($request->metric) {
            case 'unique-users':
                $data = $this->website->uniqueUsers($website, $start, $end, $startPrevious, $endPrevious, $request->group);
                break;

            case 'page-views':
                $data = $this->website->pageViews($website, $start, $end, $startPrevious, $endPrevious, $request->group);
                break;

            case 'online':
                $data = $this->website->online($website);
                break;

            case 'pages':
                $data = $this->website->pageStats($website->id, $start, $end);
                break;

            case 'entry-pages':
                $data = $this->website->entryPageStats($website->id, $start, $end);
                break;

            case 'exit-pages':
                $data = $this->website->exitPageStats($website->id, $start, $end);
                break;

            case 'referrers':
                $data = $this->website->referrerStats($website->id, $start, $end);
                break;

            case 'utm-sources':
                $data = $this->website->utmSourceStats($website->id, $start, $end);
                break;

            case 'utm-mediums':
                $data = $this->website->utmMediumStats($website->id, $start, $end);
                break;

            case 'utm-campaigns':
                $data = $this->website->utmCampaignStats($website->id, $start, $end);
                break;

            case 'utm-contents':
                $data = $this->website->utmContentStats($website->id, $start, $end);
                break;

            case 'utm-terms':
                $data = $this->website->utmTermStats($website->id, $start, $end);
                break;

            case 'browsers':
                $data = $this->website->browserStats($website->id, $start, $end);
                break;

            case 'os':
                $data = $this->website->osStats($website->id, $start, $end);
                break;

            case 'devices':
                $data = $this->website->deviceStats($website->id, $start, $end);
                break;

            case 'screens':
                $data = $this->website->screenStats($website->id, $start, $end);
                break;

            case 'languages':
                $data = $this->website->languageStats($website->id, $start, $end);
                break;

            case 'countries':
                $data = $this->website->countryStats($website->id, $start, $end);
                break;

            case 'regions':
                $data = $this->website->regionStats($website->id, $start, $end);
                break;

            case 'cities':
                $data = $this->website->cityStats($website->id, $start, $end);
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);

    }
}
