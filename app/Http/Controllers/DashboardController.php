<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function Index()
    {
        $websites = auth()->user()->websites->loadCount(['sessions' => function ($query) {
            $query->whereBetween('created_at', [now()->subHours(24), now()]);
        }]);

        return Inertia::render('Dashboard/Index', [
            'websites' => $websites
        ]);
    }
}
