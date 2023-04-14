<?php

namespace App\Http\Controllers\App;

use Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\PageView;

class BillingController extends Controller
{
    public function index()
    {
        $websites = auth()->user()->websites()->get();

        $start = now()->startOfMonth()->startOfDay();
        $end = now()->endOfMonth()->endOfDay();


        $totalEvents = PageView::whereIn('website_id', $websites->pluck('id')->toArray())
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
            $date = $date->format('Y-m-d');

            if (!isset($pageViews[$date])) {
                $pageViews[$date] = [
                    'date' => $date,
                    'views' => 0
                ];
            }
        }
        ksort($pageViews);

        $days = collect($pageViews)->pluck('date')->toArray();
        $events = collect($pageViews)->pluck('views')->toArray();

        return Inertia::render('App/Billing/Index', [
            'data' => [
                'totalEvents' => $totalEvents,
                'startCycle' => $start->format('Y-m-d'),
                'endCycle' => $end->format('Y-m-d'),
                'data' => $events,
                'labels' => $days,
                'label' => 'events'
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

    public function generateCheckoutLink(Request $request)
    {
        $checkout = $request->user()
            ->newSubscription('default', $request->stripePlan)
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('billing.index'),
                'cancel_url' => route('billing.index')
            ]);

        return response()->json($checkout->id);
    }
}
