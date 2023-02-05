<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BillingController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user->subscribed('default')) {
            return redirect(route('billing.pricing'));
        }

        return Inertia::render('Billing/Index');
    }

    public function redirectToPortal()
    {
        if (!auth()->user()->team->subscribed('default')) {
            abort(404);
        }

        return auth()->user()->team->redirectToBillingPortal(route('threads.index'));
    }

    public function pricing()
    {
        $plans = config('cashier.plans');

        return Inertia::render(
            'Billing/Pricing',
            ['plans' => $plans]
        );
    }
    public function generateCheckoutLink(Request $request)
    {

        $checkout = $request->user()
            ->team
            ->newSubscription('default', $request->stripePlan)
            ->allowPromotionCodes()
            ->trialDays(8)
            ->checkout([
                'success_url' => route('threads.index'),
                'cancel_url' => route('threads.index')
            ]);

        return response()->json($checkout->id);
    }
}
