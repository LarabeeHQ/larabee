<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Session;
use App\Models\PageView;

class WebsiteRepository
{
    public function overviewStats($websiteId, $start, $end, $prevStart, $prevEnd)
    {
        $firstData = collect(DB::select("SELECT
            count(DISTINCT table_aux.session_id) as sessions,
            sum(table_aux.c) as views,
            sum(
                CASE WHEN table_aux.c = 1 THEN
                    1
                ELSE
                    0
                END) as bounces,
            sum(table_aux.time) as totaltime
        FROM (
            select
                page_views.session_id,
                to_char(date_trunc('hour', page_views.created_at), 'YYYY-MM-DD HH24:00:00'),
                count(*) c,
                floor(extract(epoch from max(page_views.created_at) - min(page_views.created_at))) as time
            FROM
                page_views
            WHERE
                page_views.website_id = '$websiteId'
                AND page_views.created_at BETWEEN '$start' AND '$end'
            GROUP BY
                1, 2
                ) table_aux
        "))->first();

        $previousData = collect(DB::select("SELECT
            count(DISTINCT table_aux.session_id) as sessions,
            sum(table_aux.c) as views,
            sum(
                CASE WHEN table_aux.c = 1 THEN
                    1
                ELSE
                    0
                END) as bounces,
            sum(table_aux.time) as totaltime
        FROM (
            select
                page_views.session_id,
                to_char(date_trunc('hour', page_views.created_at), 'YYYY-MM-DD HH24:00:00'),
                count(*) c,
                floor(extract(epoch from max(page_views.created_at) - min(page_views.created_at))) as time
            FROM
                page_views
            WHERE
                page_views.website_id = '$websiteId'
                AND page_views.created_at BETWEEN '$prevStart' AND '$prevEnd'
            GROUP BY
                1, 2
                ) table_aux
        "))->first();

        return [
            'sessions' => [
                'change' => $firstData->sessions - $previousData->sessions,
                'value' => $firstData->sessions
            ],
            'pageViews' => [
                'change' => $firstData->views - $previousData->views,
                'value' => $firstData->views ? $firstData->views : 0
            ],
            'bounceRate' => [
                'change' => $firstData->sessions && $firstData->bounces ? ($firstData->bounces / $firstData->sessions) * 100 : 0,
                'value' => $previousData->sessions && $previousData->bounces ? ($previousData->bounces / $previousData->sessions) * 100 : 0,
            ],
            'avgSessionDuration' => [
                'value' => $firstData->totaltime && $firstData->sessions ? ceil(($firstData->totaltime / 60) / $firstData->sessions * 100) : 0,
                'change' => $previousData->totaltime && $previousData->sessions ? ceil(($previousData->totaltime / 60) / $previousData->sessions * 100) : 0,
            ],
        ];
    }

    public function pageStats($websiteId, $start, $end)
    {
        return PageView::where('website_id', $websiteId)
            ->select('url as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('url')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function exitPageStats($websiteId, $start, $end)
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
                        order by created_at desc
                        limit 1
                    ) as x
                from sessions
                where sessions.website_id = '$websiteId'
            ) as table_aux
            group by table_aux.x
            order by y desc");
    }

    public function entryPageStats($websiteId, $start, $end)
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
            group by table_aux.x
            order by y desc");
    }

    public function referrerStats($websiteId, $start, $end)
    {
        return PageView::where('website_id', $websiteId)
            ->select('referrer as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('referrer')
            ->groupBy('referrer')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function utmSourceStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_source as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_source')
            ->groupBy('utm_source')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function utmMediumStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_medium as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_medium')
            ->groupBy('utm_medium')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function utmCampaignStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_campaign as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_campaign')
            ->groupBy('utm_campaign')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function utmContentStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_content as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_content')
            ->groupBy('utm_content')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function utmTermStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('utm_term as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('utm_term')
            ->groupBy('utm_term')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function browserStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('browser as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function osStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('os as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('os')
            ->groupBy('os')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function languageStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('language as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('language')
            ->groupBy('language')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function screenStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('screen as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('screen')
            ->groupBy('screen')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function deviceStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('device as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('device')
            ->groupBy('device')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function countryStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('country as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function regionStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('region as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('region')
            ->groupBy('region')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }

    public function cityStats($websiteId, $start, $end)
    {
        return Session::where('website_id', $websiteId)
            ->select('city as x', DB::raw('count(*) as y'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderBy('y', 'desc')
            ->take(10)
            ->get();
    }
}
