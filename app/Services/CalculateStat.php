<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\Session;
use App\Models\PageView;
use App\Models\Event;

class CalculateStat
{
    public $format;

    public function __construct()
    {
        $this->format = [
            'minute' => '%Y-%m-%d %H:%i:00',
            'hour' => '%Y-%m-%d %H:00:00',
            'day' => '%Y-%m-%d',
            'month' => '%Y-%m',
            'year' => '%Y',
        ];
    }

    public function uniqueUsers($website, $timezone, $start, $end, $startPrevious, $endPrevious, $group)
    {
        $sessions = Session::selectRaw("DATE_FORMAT(created_at, '{$this->format[$group]}') as formatted_date, COUNT(*) as value")
            ->where('website_id', $website->id)
                ->whereBetween('created_at', [$start, $end])
                ->groupByRaw("DATE_FORMAT(created_at, '{$this->format[$group]}')")
                ->orderByRaw("DATE_FORMAT(created_at, '{$this->format[$group]}') asc")
                ->get();

        // Total sessions for the current period
        $total = Session::where('website_id', $website->id)
            ->whereBetween('created_at', [$start, $end])
            ->count();

        // Total sessions for the previous period
        $totalPrevious = Session::where('website_id', $website->id)->whereBetween('created_at', [$startPrevious, $endPrevious])->count();

        // Formatting labels based on the grouping
        $labels = $sessions->pluck('formatted_date')->map(function ($label) use ($group, $timezone) {
            switch ($group) {
                case 'hour':
                    return Carbon::createFromFormat('Y-m-d H:i:s', $label)->tz($timezone)->format('ga');
                case 'day':
                    return Carbon::createFromFormat('Y-m-d', $label)->tz($timezone)->format('d M');
                case 'month':
                    return Carbon::createFromFormat('Y-m', $label)->tz($timezone)->format('F Y'); // Handle 'Y-m' format
                case 'year':
                    return Carbon::createFromFormat('Y', $label)->tz($timezone)->format('Y'); // Handle 'Y' format
                default:
                    return $label;
            }
        });

        return [
            'total' => $total,
            'totalPrevious' => $total == 0 || $totalPrevious == 0 ? 0 : round(((1 - $total / $totalPrevious) * 100), 2),
            'chart' => [
                'data' => $sessions->pluck('value')->toArray(),
                'label' => 'Users',
                'labels' => $labels,
            ],
        ];
    }

    public function pageViews($website, $timezone, $start, $end, $startPrevious, $endPrevious, $group)
    {

        $pageViews = PageView::selectRaw("DATE_FORMAT(created_at, '{$this->format[$group]}') as formatted_date, COUNT(*) as value")
        ->where('website_id', $website->id)
            ->whereBetween('created_at', [$start, $end])
            ->groupByRaw("DATE_FORMAT(created_at, '{$this->format[$group]}')")
            ->orderByRaw("DATE_FORMAT(created_at, '{$this->format[$group]}') asc")
            ->get();

        // Total page views for the current period
        $total = PageView::where('website_id', $website->id)
            ->whereBetween('created_at', [$start, $end])
            ->count();

        // Total page views for the previous period
        $totalPrevious = PageView::where('website_id', $website->id)->whereBetween('created_at', [$startPrevious, $endPrevious])->count();

        // Formatting labels based on the grouping
        $labels = $pageViews->pluck('formatted_date')->map(function ($label) use ($group, $timezone) {
            switch ($group) {
                case 'hour':
                    return Carbon::createFromFormat('Y-m-d H:i:s', $label)->tz($timezone)->format('ga');
                case 'day':
                    return Carbon::createFromFormat('Y-m-d', $label)->tz($timezone)->format('d M');
                case 'month':
                    return Carbon::createFromFormat('Y-m', $label)->tz($timezone)->format('F Y'); // Handle 'Y-m' format
                case 'year':
                    return Carbon::createFromFormat('Y', $label)->tz($timezone)->format('Y'); // Handle 'Y' format
                default:
                    return $label;
            }
        });

        return [
            'total' => $total,
            'totalPrevious' => $total == 0 || $totalPrevious == 0 ? 0 : round(((1 - $total / $totalPrevious) * 100), 2),
            'chart' => [
                'data' => $pageViews->pluck('value')->toArray(),
                'label' => 'Page Views',
                'labels' => $labels,
            ],
        ];
    }

    public function online($website)
    {
        return Session::where('website_id', $website->id)
            ->where('created_at', '>=', now()->subMinutes($website->session_duration))
            ->count();
    }

    public function pageStats($websiteId, $start,$end, $limit = 10)
    {
        return PageView::where('website_id', $websiteId)
            ->select('url as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('url')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function exitPageStats($websiteId, $start, $end, $limit = 10)
    {
        return DB::select("select
                table_aux.x,
                count(*) as y
                from (
                    select
                        sessions.id,
                        (
                            select page_views.url from page_views
                            where page_views.session_id = sessions.id
                            AND page_views.created_at BETWEEN '$start' AND '$end'
                            order by page_views.created_at desc
                            limit 1
                        ) as x
                    from sessions
                    where sessions.website_id = '$websiteId'
                ) as table_aux
                where table_aux.x is not null
                group by table_aux.x
                order by y desc limit $limit");
    }

    public function entryPageStats($websiteId, $start, $end, $limit = 10)
    {
        return DB::select("select
                table_aux.x,
                count(*) as y
            from (
                select
                    sessions.id,
                    (
                        select page_views.url from page_views
                        where page_views.session_id = sessions.id
                        AND page_views.created_at BETWEEN '$start' AND '$end'
                        order by created_at asc
                        limit 1
                    ) as x
                from sessions
                where sessions.website_id = '$websiteId'
            ) as table_aux
            where table_aux.x is not null
            group by table_aux.x
            order by y desc limit $limit");
    }

    public function referrerStats($websiteId, $start, $end, $limit = 10)
    {
        return PageView::where('website_id', $websiteId)
            ->select(DB::raw("count(*) as y, CASE WHEN referrer IS NULL THEN 'Direct' ELSE referrer END AS x"))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('x')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function utmSourceStats($websiteId, $start,$end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_source as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_source')
            ->groupBy('utm_source')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function utmMediumStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_medium as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_medium')
            ->groupBy('utm_medium')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function utmCampaignStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_campaign as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_campaign')
            ->groupBy('utm_campaign')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function utmContentStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_content as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_content')
            ->groupBy('utm_content')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function utmTermStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_term as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_term')
            ->groupBy('utm_term')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function events($websiteId, $start, $end, $limit = 10)
    {
        return Event::where('website_id', $websiteId)
            ->select('name as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('name')
            ->groupBy('name')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function browserStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('browser as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function osStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('os as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('os')
            ->groupBy('os')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function languageStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('language as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('language')
            ->groupBy('language')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function screenStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('screen as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('screen')
            ->groupBy('screen')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function deviceStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('device as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('device')
            ->groupBy('device')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function countryStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('country as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function regionStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('region as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('region')
            ->groupBy('region')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }

    public function cityStats($websiteId, $start, $end, $limit = 10)
    {
        return Session::where('website_id', $websiteId)
            ->select('city as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderBy('y', 'desc')
            ->take($limit)
            ->get();
    }
}
