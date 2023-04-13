<?php

namespace App\Http\Controllers;

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

        $pageViews = PageView::
            select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
            ->whereIn('website_id', $websites->pluck('id')->toArray())
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('date', 'asc')
            ->groupBy('date')
            ->get()
            ->mapWithKeys(function ($item, $key) {
                return [$item['date'] => $item['views']];
            })
            ->toArray();


        $period = CarbonPeriod::create($start, $end);

        foreach ($period as $date) {
            $date = $date->format('Y-m-d');

            if (!isset($pageViews[$date])) {
                $pageViews[$date] = 0;
            }
        }

        ksort($pageViews);

        return Inertia::render('Billing/Index', [
            'websites' => $websites,
            'pageViews' => $pageViews,
        ]);
    }

    public function redirectToPortal()
    {
        if (!auth()->user()->subscribed('default')) {
            abort(404);
        }

        $url = auth()->user()->billingPortalUrl(route('dashboard'));

        return Inertia::location($url);

    }

    public function generateCheckoutLink(Request $request)
    {
        $checkout = $request->user()
            ->newSubscription('default', $request->stripePlan)
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url' => route('dashboard')
            ]);

        return response()->json($checkout->id);
    }
}
