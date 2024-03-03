<?php

namespace App\Http\Controllers\App;

use Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Event;
use App\Models\PageView;

class BillingController extends Controller
{
    public function index()
    {
        // auth()->user()->subscription('default')->reportUsage(3);

        $websites = auth()->user()->websites()->get();

        $start = now()->tz('UTC')->startOfMonth()->startOfDay();
        $end = now()->tz('UTC')->endOfMonth()->endOfDay();

        $totalSites = $websites->count();

        $totalPageViews = PageView::whereIn('website_id', $websites->pluck('id')->toArray())
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $totalEvents = Event::whereIn('website_id', $websites->pluck('id')->toArray())
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $pageViews = PageView::
            select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
            ->whereIn('website_id', $websites->pluck('id')->toArray())
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('date', 'asc')
            ->groupBy('date')
            ->get()
            ->mapWithKeys(function ($item, $key) {
                return [$item['date'] => [
                    'date' => $item['date'],
                    'views' => $item['views']
                ]];
            })
            ->toArray();

        $period = CarbonPeriod::create($start, $end);
        foreach ($period as $date) {
            $day = $date->format('Y-m-d');

            if (!isset($pageViews[$day])) {
                $pageViews[$day] = [
                    'date' => $date->format('d M'),
                    'views' => 0
                ];
            }
            else {
                $pageViews[$day]['date'] = $date->format('d M');
            }

        }
        ksort($pageViews);

        $days = collect($pageViews)->pluck('date')->toArray();
        $events = collect($pageViews)->pluck('views')->toArray();

        return Inertia::render('App/Billing/Index', [
            'data' => [
                'totalEvents' => $totalPageViews + $totalEvents,
                'startCycle' => $start->format('Y-m-d'),
                'endCycle' => $end->format('Y-m-d'),
                'data' => $events,
                'labels' => $days,
                'label' => 'events',
                'totalSites' => $totalSites,
            ],
        ]);
    }

    public function redirectToPortal()
    {
        if (!auth()->user()->subscribed('default')) {
            abort(404);
        }

        $url = auth()->user()->billingPortalUrl(route('billing.index'));

        return Inertia::location($url);
    }

    public function checkout(Request $request)
    {
        return $request->user()
            ->newSubscription('default')
            ->meteredPrice(env('STRIPE_PRICE_ID'))
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('billing.index'),
                'cancel_url' => route('billing.index')
            ]);
    }
}
