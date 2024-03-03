<?php

namespace App\Services;

class Bot
{

    public function isBot($userAgent)
    {
        $bots = $this->listBots();

        foreach ($bots as $bot) {
            if (preg_match("/{$bot['regex']}/i", $userAgent)) {
                return true;
            }
        }

        return false;
    }

    public function listBots()
    {

        return [
            [
                'regex' => 'monitoring360bot',
                'name' => '360 Monitoring',
                'category' => 'Site Monitor',
                'url' => 'https://www.360monitoring.io',
                'producer' => [
                    'name' => 'Plesk International GmbH',
                    'url' => 'https://www.plesk.com',
                ],
            ],
            [
                'regex' => 'Cloudflare-Healthchecks',
                'name' => 'Cloudflare Health Checks',
                'category' => 'Service Agent',
                'url' => 'https://developers.cloudflare.com/health-checks/',
                'producer' => [
                    'name' => 'CloudFlare',
                    'url' => 'http://www.cloudflare.com',
                ],
            ],
            [
                'regex' => '360Spider',
                'name' => '360Spider',
                'category' => 'Search bot',
                'url' => 'https://www.so.com/help/help_3_2.html',
                'producer' => [
                    'name' => 'Online Media Group, Inc.',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Aboundex',
                'name' => 'Aboundexbot',
                'category' => 'Search bot',
                'url' => 'http://www.aboundex.com/crawler/',
                'producer' => [
                    'name' => 'Aboundex.com',
                    'url' => 'http://www.aboundex.com',
                ],
            ],
            [
                'regex' => 'AcoonBot',
                'name' => 'Acoon',
                'category' => 'Search bot',
                'url' => 'http://www.acoon.de/robot.asp',
                'producer' => [
                    'name' => 'Acoon GmbH',
                    'url' => 'http://www.acoon.de',
                ],
            ],
            [
                'regex' => 'AddThis\\.com',
                'name' => 'AddThis.com',
                'category' => 'Social Media Agent',
                'url' => '',
                'producer' => [
                    'name' => 'Clearspring Technologies, Inc.',
                    'url' => 'http://www.clearspring.com',
                ],
            ],
            [
                'regex' => 'AhrefsBot',
                'name' => 'aHrefs Bot',
                'category' => 'Crawler',
                'url' => 'https://ahrefs.com/robot',
                'producer' => [
                    'name' => 'Ahrefs Pte Ltd',
                    'url' => 'https://ahrefs.com/robot',
                ],
            ],
            [
                'regex' => 'AhrefsSiteAudit\\/([\d+.]+)',
                'name' => 'AhrefsSiteAudit',
                'category' => 'Site Monitor',
                'url' => 'https://ahrefs.com/robot/site-audit',
                'producer' => [
                    'name' => 'Ahrefs Pte Ltd',
                    'url' => 'https://ahrefs.com/',
                ],
            ],
            [
                'regex' => 'ia_archiver|alexabot|verifybot',
                'name' => 'Alexa Crawler',
                'category' => 'Search bot',
                'url' => 'https://support.alexa.com/hc/en-us/sections/200100794-Crawlers',
                'producer' => [
                    'name' => 'Alexa Internet',
                    'url' => 'https://www.alexa.com',
                ],
            ],
            [
                'regex' => 'alexa site audit',
                'name' => 'Alexa Site Audit',
                'category' => 'Site Monitor',
                'url' => 'https://support.alexa.com/hc/en-us/articles/200450194',
                'producer' => [
                    'name' => 'Alexa Internet',
                    'url' => 'https://www.alexa.com',
                ],
            ],
            [
                'regex' => 'Amazonbot',
                'name' => 'Amazon Bot',
                'category' => 'Crawler',
                'url' => 'https://developer.amazon.com/support/amazonbot',
                'producer' => [
                    'name' => 'Amazon.com, Inc.',
                    'url' => 'https://www.amazon.com/',
                ],
            ],
            [
                'regex' => 'Amazon[ -]Route ?53[ -]Health[ -]Check[ -]Service',
                'name' => 'Amazon Route53 Health Check',
                'category' => 'Service Agent',
                'producer' => [
                    'name' => 'Amazon Web Services',
                    'url' => 'https://aws.amazon.com/',
                ],
            ],
            [
                'regex' => 'AmorankSpider',
                'name' => 'Amorank Spider',
                'category' => 'Crawler',
                'url' => 'http://amorank.com/webcrawler.html',
                'producer' => [
                    'name' => 'Amorank',
                    'url' => 'http://www.amorank.com',
                ],
            ],
            [
                'regex' => 'ApacheBench',
                'name' => 'ApacheBench',
                'category' => 'Benchmark',
                'url' => 'https://httpd.apache.org/docs/2.4/programs/ab.html',
                'producer' => [
                    'name' => 'The Apache Software Foundation',
                    'url' => 'https://www.apache.org/foundation/',
                ],
            ],
            [
                'regex' => 'Applebot',
                'name' => 'Applebot',
                'category' => 'Crawler',
                'url' => 'https://support.apple.com/en-us/HT204683',
                'producer' => [
                    'name' => 'Apple Inc',
                    'url' => 'https://www.apple.com',
                ],
            ],
            [
                'regex' => 'AppSignalBot',
                'name' => 'AppSignalBot',
                'category' => 'Site Monitor',
                'url' => 'https://docs.appsignal.com/uptime-monitoring/',
                'producer' => [
                    'name' => 'AppSignal',
                    'url' => 'https://appsignal.com/',
                ],
            ],
            [
                'regex' => 'Arachni',
                'name' => 'Arachni',
                'category' => 'Security Checker',
                'url' => 'https://www.arachni-scanner.com/',
                'producer' => [
                    'name' => 'Sarosys LLC',
                    'url' => 'https://www.sarosys.com/',
                ],
            ],
            [
                'regex' => 'AspiegelBot',
                'name' => 'AspiegelBot',
                'category' => 'Crawler',
                'url' => 'https://aspiegel.com/',
                'producer' => [
                    'name' => 'Huawei',
                    'url' => 'https://www.huawei.com/',
                ],
            ],
            [
                'regex' => 'Castro 2, Episode Duration Lookup',
                'name' => 'Castro 2',
                'category' => 'Service Agent',
                'url' => 'http://supertop.co/castro/',
                'producer' => [
                    'name' => 'Supertop',
                    'url' => 'http://supertop.co',
                ],
            ],
            [
                'regex' => 'Curious George',
                'name' => 'Analytics SEO Crawler',
                'category' => 'Crawler',
                'url' => 'http://www.analyticsseo.com/crawler',
                'producer' => [
                    'name' => 'Analytics SEO',
                    'url' => 'http://www.analyticsseo.com',
                ],
            ],
            [
                'regex' => 'archive\\.org_bot|special_archiver',
                'name' => 'archive.org bot',
                'category' => 'Crawler',
                'url' => 'https://archive.org/details/archive.org_bot',
                'producer' => [
                    'name' => 'The Internet Archive',
                    'url' => 'https://archive.org',
                ],
            ],
            [
                'regex' => 'Ask Jeeves\\/Teoma',
                'name' => 'Ask Jeeves',
                'category' => 'Search bot',
                'url' => '',
                'producer' => [
                    'name' => 'Ask Jeeves Inc.',
                    'url' => 'http://www.ask.com',
                ],
            ],
            [
                'regex' => 'Backlink-Check\\.de',
                'name' => 'Backlink-Check.de',
                'category' => 'Crawler',
                'url' => 'http://www.backlink-check.de/bot.html',
                'producer' => [
                    'name' => 'Mediagreen Medienservice',
                    'url' => 'http://www.backlink-check.de',
                ],
            ],
            [
                'regex' => 'BacklinkCrawler',
                'name' => 'BacklinkCrawler',
                'category' => 'Crawler',
                'url' => 'http://www.backlinktest.com/crawler.html',
                'producer' => [
                    'name' => '2.0Promotion GbR',
                    'url' => 'http://www.backlinktest.com',
                ],
            ],
            [
                'regex' => 'Baidu.*spider|baidu Transcoder',
                'name' => 'Baidu Spider',
                'category' => 'Search bot',
                'url' => 'http://www.baidu.com/search/spider.htm',
                'producer' => [
                    'name' => 'Baidu',
                    'url' => 'http://www.baidu.com',
                ],
            ],
            [
                'regex' => 'BazQux',
                'name' => 'BazQux Reader',
                'url' => 'https://bazqux.com/fetcher',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Better Uptime Bot',
                'name' => 'Better Uptime Bot',
                'category' => 'Site Monitor',
                'url' => 'https://betteruptime.com/faq',
                'producer' => [
                    'name' => 'Better Uptime',
                    'url' => 'https://betteruptime.com/',
                ],
            ],
            [
                'regex' => 'MSNBot|msrbot|bingbot|BingPreview|msnbot-(UDiscovery|NewsBlogs)|adidxbot',
                'name' => 'BingBot',
                'category' => 'Search bot',
                'url' => 'http://search.msn.com/msnbot.htmn',
                'producer' => [
                    'name' => 'Microsoft Corporation',
                    'url' => 'http://www.microsoft.com',
                ],
            ],
            [
                'regex' => 'Blekkobot',
                'name' => 'Blekkobot',
                'category' => 'Search bot',
                'url' => 'http://blekko.com/about/blekkobot',
                'producer' => [
                    'name' => 'Blekko',
                    'url' => 'http://blekko.com',
                ],
            ],
            [
                'regex' => 'BLEXBot',
                'name' => 'BLEXBot Crawler',
                'category' => 'Crawler',
                'url' => 'http://webmeup-crawler.com',
                'producer' => [
                    'name' => 'WebMeUp',
                    'url' => 'http://webmeup.com',
                ],
            ],
            [
                'regex' => 'Bloglovin',
                'name' => 'Bloglovin',
                'url' => 'http://www.bloglovin.com',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Blogtrottr',
                'name' => 'Blogtrottr',
                'url' => '',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => 'Blogtrottr Ltd',
                    'url' => 'https://blogtrottr.com/',
                ],
            ],
            [
                'regex' => 'BoardReader Blog Indexer',
                'name' => 'BoardReader Blog Indexer',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'BoardReader',
                    'url' => 'https://boardreader.com/',
                ],
            ],
            [
                'regex' => 'BountiiBot',
                'name' => 'Bountii Bot',
                'category' => 'Search bot',
                'url' => 'http://bountii.com/contact.php',
                'producer' => [
                    'name' => 'Bountii Inc.',
                    'url' => 'http://bountii.com',
                ],
            ],
            [
                'regex' => 'Browsershots',
                'name' => 'Browsershots',
                'category' => 'Service Agent',
                'url' => 'http://browsershots.org/faq',
                'producer' => [
                    'name' => 'Browsershots.org',
                    'url' => 'http://browsershots.org',
                ],
            ],
            [
                'regex' => 'BUbiNG',
                'name' => 'BUbiNG',
                'category' => 'Crawler',
                'url' => 'http://law.di.unimi.it/BUbiNG.html',
                'producer' => [
                    'name' => 'The Laboratory for Web Algorithmics (LAW)',
                    'url' => 'http://law.di.unimi.it/software.php#buging',
                ],
            ],
            [
                'regex' => '(?<!HTC)[ _]Butterfly\\/',
                'name' => 'Butterfly Robot',
                'category' => 'Search bot',
                'url' => 'http://labs.topsy.com/butterfly',
                'producer' => [
                    'name' => 'Topsy Labs',
                    'url' => 'http://labs.topsy.com',
                ],
            ],
            [
                'regex' => 'CareerBot',
                'name' => 'CareerBot',
                'category' => 'Crawler',
                'url' => 'http://www.career-x.de/bot.html',
                'producer' => [
                    'name' => 'career-x GmbH',
                    'url' => 'http://www.career-x.de',
                ],
            ],
            [
                'regex' => 'CCBot',
                'name' => 'ccBot crawler',
                'category' => 'Crawler',
                'url' => 'http://commoncrawl.org/faq/',
                'producer' => [
                    'name' => 'reddit inc.',
                    'url' => 'http://www.reddit.com',
                ],
            ],
            [
                'regex' => 'Cliqzbot',
                'name' => 'Cliqzbot',
                'category' => 'Crawler',
                'url' => 'http://cliqz.com/company/cliqzbot',
                'producer' => [
                    'name' => '10betterpages GmbH',
                    'url' => 'http://cliqz.com',
                ],
            ],
            [
                'regex' => 'Cloudflare-AMP',
                'name' => 'CloudFlare AMP Fetcher',
                'category' => 'Crawler',
                'url' => 'https://amp.cloudflare.com/doc/fetcher.html',
                'producer' => [
                    'name' => 'CloudFlare',
                    'url' => 'http://www.cloudflare.com',
                ],
            ],
            [
                'regex' => 'CloudflareDiagnostics',
                'name' => 'Cloudflare Diagnostics',
                'category' => 'Site Monitor',
                'url' => 'https://www.cloudflare.com/',
                'producer' => [
                    'name' => 'Cloudflare',
                    'url' => 'https://www.cloudflare.com',
                ],
            ],
            [
                'regex' => 'CloudFlare-AlwaysOnline',
                'name' => 'CloudFlare Always Online',
                'category' => 'Site Monitor',
                'url' => 'http://www.cloudflare.com/always-online',
                'producer' => [
                    'name' => 'CloudFlare',
                    'url' => 'http://www.cloudflare.com',
                ],
            ],
            [
                'regex' => 'coccoc.com',
                'name' => 'Cốc Cốc Bot',
                'url' => 'https://help.coccoc.com/en/search-engine/coccoc-robots',
                'category' => 'Search bot',
                'producer' => [
                    'name' => 'Cốc Cốc',
                    'url' => 'https://coccoc.com/',
                ],
            ],
            [
                'regex' => 'collectd',
                'name' => 'Collectd',
                'url' => 'https://collectd.org/',
                'category' => 'Site Monitor',
                'producer' => [
                    'name' => 'Collectd',
                    'url' => 'https://collectd.org/',
                ],
            ],
            [
                'regex' => 'CommaFeed',
                'name' => 'CommaFeed',
                'url' => 'http://www.commafeed.com',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'CSS Certificate Spider',
                'name' => 'CSS Certificate Spider',
                'category' => 'Crawler',
                'url' => 'http://www.css-security.com/certificatespider/',
                'producer' => [
                    'name' => 'Certified Security Solutions',
                    'url' => 'https://www.css-security.com/company/about-us/',
                ],
            ],
            [
                'regex' => 'Datadog Agent|Datadog\\/?Synthetics',
                'name' => 'Datadog Agent',
                'url' => 'https://github.com/DataDog/dd-agent',
                'category' => 'Site Monitor',
                'producer' => [
                    'name' => 'Datadog',
                    'url' => 'https://www.datadoghq.com/',
                ],
            ],
            [
                'regex' => 'Datanyze',
                'name' => 'Datanyze',
                'url' => '',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'Datanyze',
                    'url' => 'https://www.datanyze.com',
                ],
            ],
            [
                'regex' => 'Dataprovider',
                'name' => 'Dataprovider',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Dataprovider B.V.',
                    'url' => 'https://www.dataprovider.com/',
                ],
            ],
            [
                'regex' => 'Daum(oa)?[ \\/][0-9]',
                'name' => 'Daum',
                'category' => 'Search bot',
                'url' => 'http://tab.search.daum.net/aboutWebSearch_en.html',
                'producer' => [
                    'name' => 'Daum Communications Corp.',
                    'url' => 'http://www.kakaocorp.com/main',
                ],
            ],
            [
                'regex' => 'Dazoobot',
                'name' => 'Dazoobot',
                'category' => 'Search bot',
                'url' => '',
                'producer' => [
                    'name' => 'DAZOO.FR',
                    'url' => 'http://dazoo.fr',
                ],
            ],
            [
                'regex' => 'discobot',
                'name' => 'Discobot',
                'category' => 'Search bot',
                'url' => 'http://discoveryengine.com/discobot.html',
                'producer' => [
                    'name' => 'Discovery Engine',
                    'url' => 'http://discoveryengine.com',
                ],
            ],
            [
                'regex' => 'Domain Re-Animator Bot|support@domainreanimator.com',
                'name' => 'Domain Re-Animator Bot',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Domain Re-Animator, LLC',
                    'url' => 'http://domainreanimator.com',
                ],
            ],
            [
                'regex' => 'DotBot',
                'name' => 'DotBot',
                'category' => 'Crawler',
                'url' => 'http://www.opensiteexplorer.org/dotbot',
                'producer' => [
                    'name' => 'SEOmoz, Inc.',
                    'url' => 'http://moz.com/',
                ],
            ],
            [
                'regex' => 'DuckDuck(?:Go-Favicons-)?Bot',
                'name' => 'DuckDuckGo Bot',
                'category' => 'Search bot',
                'url' => 'https://duckduckgo.com/duckduckbot',
                'producer' => [
                    'name' => 'DuckDuckGo',
                    'url' => 'https://duckduckgo.com/',
                ],
            ],
            [
                'regex' => 'EasouSpider',
                'name' => 'Easou Spider',
                'category' => 'Search bot',
                'url' => 'http://www.easou.com/search/spider.html',
                'producer' => [
                    'name' => 'easou ICP',
                    'url' => 'http://www.easou.com',
                ],
            ],
            [
                'regex' => 'eCairn-Grabber',
                'name' => 'eCairn-Grabber',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'eCairn',
                    'url' => 'https://ecairn.com',
                ],
            ],
            [
                'regex' => 'EMail Exractor',
                'name' => 'EMail Exractor',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'evc-batch',
                'name' => 'evc-batch',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'eVenture Capital Partners II, LLC',
                    'url' => 'http://www.eventures.vc/',
                ],
            ],
            [
                'regex' => 'Exabot|ExaleadCloudview',
                'name' => 'ExaBot',
                'category' => 'Crawler',
                'url' => 'http://www.exabot.com/go/robot',
                'producer' => [
                    'name' => 'Dassault Systèmes',
                    'url' => 'http://www.3ds.com',
                ],
            ],
            [
                'regex' => 'ExactSeek Crawler',
                'name' => 'ExactSeek Crawler',
                'category' => 'Search bot',
                'url' => 'http://www.exactseek.com',
                'producer' => [
                    'name' => 'Jayde Online, Inc.',
                    'url' => 'http://www.jaydeonlineinc.com',
                ],
            ],
            [
                'regex' => 'Ezooms',
                'name' => 'Ezooms',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'SEOmoz, Inc.',
                    'url' => 'http://moz.com/',
                ],
            ],
            [
                'regex' => 'facebookexternalhit|facebookplatform|facebookexternalua|facebookcatalog',
                'name' => 'Facebook External Hit',
                'category' => 'Social Media Agent',
                'url' => 'https://www.facebook.com/externalhit_uatext.php',
                'producer' => [
                    'name' => 'Facebook',
                    'url' => 'http://www.facebook.com',
                ],
            ],
            [
                'regex' => 'Feedbin',
                'name' => 'Feedbin',
                'url' => 'http://feedbin.com/',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'FeedBurner',
                'name' => 'FeedBurner',
                'url' => 'http://www.feedburner.com',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Feed Wrangler',
                'name' => 'Feed Wrangler',
                'url' => 'https://feedwrangler.net/',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => 'David Smith & Developing Perspective, LLC',
                    'url' => 'https://david-smith.org',
                ],
            ],
            [
                'regex' => 'Feedly',
                'name' => 'Feedly',
                'url' => 'http://www.feedly.com',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Feedspot',
                'name' => 'Feedspot',
                'url' => 'http://www.feedspot.com',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Fever\\/[0-9]',
                'name' => 'Fever',
                'url' => 'http://feedafever.com/',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'FlipboardProxy|FlipboardRSS',
                'name' => 'Flipboard',
                'url' => 'http://flipboard.com/browserproxy',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => 'Flipboard',
                    'url' => 'http://flipboard.com/',
                ],
            ],
            [
                'regex' => 'Findxbot',
                'name' => 'Findxbot',
                'category' => 'Crawler',
                'url' => 'http://www.findxbot.com',
            ],
            [
                'regex' => 'FreshRSS',
                'name' => 'FreshRSS',
                'category' => 'Feed Fetcher',
                'url' => 'https://freshrss.org/',
            ],
            [
                'regex' => 'Genieo',
                'name' => 'Genieo Web filter',
                'category' => '',
                'url' => 'http://www.genieo.com/webfilter.html',
                'producer' => [
                    'name' => 'Genieo',
                    'url' => 'http://www.genieo.com',
                ],
            ],
            [
                'regex' => 'GigablastOpenSource',
                'name' => 'Gigablast',
                'category' => 'Search bot',
                'url' => 'https://github.com/gigablast/open-source-search-engine',
                'producer' => [
                    'name' => 'Matt Wells',
                    'url' => 'http://www.gigablast.com/faq.html',
                ],
            ],
            [
                'regex' => 'Gluten Free Crawler',
                'name' => 'Gluten Free Crawler',
                'category' => 'Crawler',
                'url' => 'http://glutenfreepleasure.com/',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'gobuster',
                'name' => 'Gobuster',
                'url' => 'https://github.com/OJ/gobuster',
            ],
            [
                'regex' => 'ichiro\\/mobile goo',
                'name' => 'Goo',
                'category' => 'Search bot',
                'url' => 'http://search.goo.ne.jp/option/use/sub4/sub4-1',
                'producer' => [
                    'name' => 'NTT Resonant',
                    'url' => 'http://goo.ne.jp',
                ],
            ],
            [
                'regex' => 'Storebot-Google',
                'name' => 'Google StoreBot',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'Google Favicon',
                'name' => 'Google Favicon',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'Google Search Console',
                'name' => 'Google Search Console',
                'category' => 'Crawler',
                'url' => 'https://search.google.com/search-console/about',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'http://www.google.com',
                ],
            ],
            [
                'regex' => 'Google Page Speed Insights',
                'name' => 'Google PageSpeed Insights',
                'category' => 'Site Monitor',
                'url' => 'http://developers.google.com/speed/pagespeed/insights/',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'http://www.google.com',
                ],
            ],
            [
                'regex' => 'google_partner_monitoring',
                'name' => 'Google Partner Monitoring',
                'category' => 'Site Monitor',
                'url' => '',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'http://www.google.com',
                ],
            ],
            [
                'regex' => 'Google-Cloud-Scheduler',
                'name' => 'Google Cloud Scheduler',
                'category' => 'Crawler',
                'url' => 'https://cloud.google.com/scheduler',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'https://www.google.com',
                ],
            ],
            [
                'regex' => 'Google-Structured-Data-Testing-Tool',
                'name' => 'Google Structured Data Testing Tool',
                'category' => 'Validator',
                'url' => 'https://search.google.com/structured-data/testing-tool',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'http://www.google.com',
                ],
            ],
            [
                'regex' => 'GoogleStackdriverMonitoring',
                'name' => 'Google Stackdriver Monitoring',
                'category' => 'Site Monitor',
                'url' => 'https://cloud.google.com/monitoring',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'https://www.google.com',
                ],
            ],
            [
                'regex' => 'via ggpht\\.com GoogleImageProxy',
                'name' => 'Gmail Image Proxy',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'http://www.google.com',
                ],
            ],
            [
                'regex' => 'SeznamEmailProxy',
                'name' => 'Seznam Email Proxy',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Seznam.cz, a.s.',
                    'url' => 'http://www.seznam.cz/',
                ],
            ],
            [
                'regex' => 'Seznam-Zbozi-robot',
                'name' => 'Seznam Zbozi.cz',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Seznam.cz, a.s.',
                    'url' => 'https://www.zbozi.cz/',
                ],
            ],
            [
                'regex' => 'Heurekabot-Feed',
                'name' => 'Heureka Feed',
                'category' => 'Crawler',
                'url' => 'https://sluzby.heureka.cz/napoveda/heurekabot/',
                'producer' => [
                    'name' => 'Heureka.cz, a.s.',
                    'url' => 'https://www.heureka.cz/',
                ],
            ],
            [
                'regex' => 'ShopAlike',
                'name' => 'ShopAlike',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Visual Meta',
                    'url' => 'https://www.shopalike.cz/',
                ],
            ],
            [
                'regex' => 'AdsBot-Google|Adwords-(DisplayAds|Express|Instant)|Google Web Preview|Google[ -]Publisher[ -]Plugin|Google-(Ads-Conversions|Ads-Qualify|Adwords|AMPHTML|Assess|HotelAdsVerifier|InspectionTool|Read-Aloud|Shopping-Quality|Site-Verification|speakr|Stale-Content-Probe|Test|Youtube-Links)|(APIs|DuplexWeb|Feedfetcher|Mediapartners)-Google|Googlebot|Google(?:AdSenseInfeed|AssociationService|Other|Prober|Producer)|Google.*\/\\+\/web\/snippet',
                'name' => 'Googlebot',
                'category' => 'Search bot',
                'url' => 'http://www.google.com/bot.html',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'http://www.google.com',
                ],
            ],
            [
                'regex' => '^Google$',
                'name' => 'Googlebot',
                'category' => 'Search bot',
                'url' => 'http://www.google.com/bot.html',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'http://www.google.com',
                ],
            ],
            [
                'regex' => 'heritrix',
                'name' => 'Heritrix',
                'category' => 'Crawler',
                'url' => 'https://webarchive.jira.com/wiki/display/Heritrix/Heritrix',
                'producer' => [
                    'name' => 'The Internet Archive',
                    'url' => 'https://archive.org',
                ],
            ],
            [
                'regex' => 'HubSpot ',
                'name' => 'HubSpot',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'HubSpot Inc.',
                    'url' => 'https://www.hubspot.com',
                ],
            ],
            [
                'regex' => 'vuhuvBot',
                'name' => 'Vuhuv Bot',
                'category' => 'Crawler',
                'url' => 'http://vuhuv.com/bot.html',
            ],
            [
                'regex' => 'HTTPMon',
                'name' => 'HTTPMon',
                'category' => 'Site Monitor',
                'url' => 'http://www.httpmon.com',
                'producer' => [
                    'name' => 'towards GmbH',
                    'url' => 'http://www.towards.ch/',
                ],
            ],
            [
                'regex' => 'ICC-Crawler',
                'name' => 'ICC-Crawler',
                'category' => 'Crawler',
                'url' => 'http://www.nict.go.jp/en/univ-com/plan/crawl.html',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'inoreader.com',
                'name' => 'inoreader',
                'category' => 'Feed Reader',
                'url' => 'https://www.inoreader.com',
            ],
            [
                'regex' => 'iisbot',
                'name' => 'IIS Site Analysis',
                'category' => 'Crawler',
                'url' => 'http://www.iis.net/iisbot.html',
                'producer' => [
                    'name' => 'Microsoft Corporation',
                    'url' => 'http://www.microsoft.com',
                ],
            ],
            [
                'regex' => 'ips-agent',
                'name' => 'IPS Agent',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'VeriSign, Inc',
                    'url' => 'http://www.verisign.com/',
                ],
            ],
            [
                'regex' => 'IP-Guide\\.com',
                'name' => 'IP-Guide Crawler',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => '',
                    'url' => 'https://ip-guide.com',
                ],
            ],
            [
                'regex' => 'k6\\/[0-9\\.]+',
                'name' => 'K6',
                'url' => 'https://k6.io/',
            ],
            [
                'regex' => 'kouio',
                'name' => 'Kouio',
                'url' => 'http://kouio.com/',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'larbin',
                'name' => 'Larbin web crawler',
                'category' => 'Crawler',
                'url' => 'http://larbin.sourceforge.net',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => '([A-z0-9]*)-Lighthouse',
                'name' => 'Lighthouse',
                'category' => 'Site Monitor',
                'url' => 'https://developers.google.com/web/tools/lighthouse',
                'producer' => [
                    'name' => 'Lighthouse',
                    'url' => 'https://developers.google.com/web/tools/lighthouse',
                ],
            ],
            [
                'regex' => 'last-modified\\.com',
                'name' => 'LastMod Bot',
                'category' => 'Site Monitor',
                'url' => 'https://last-modified.com/en/about',
                'producer' => [
                    'name' => '',
                    'url' => 'https://last-modified.com/en',
                ],
            ],
            [
                'regex' => 'linkdexbot|linkdex\\.com',
                'name' => 'Linkdex Bot',
                'category' => 'Search bot',
                'url' => 'http://www.linkdex.com/bots',
                'producer' => [
                    'name' => 'Mojeek Ltd.',
                    'url' => 'http://www.mojeek.com',
                ],
            ],
            [
                'regex' => 'LinkedInBot',
                'name' => 'LinkedIn Bot',
                'category' => 'Social Media Agent',
                'url' => 'http://www.linkedin.com',
                'producer' => [
                    'name' => 'LinkedIn',
                    'url' => 'http://www.linkedin.com',
                ],
            ],
            [
                'regex' => 'ltx71',
                'name' => 'LTX71',
                'url' => 'http://ltx71.com/',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Mail\\.RU',
                'name' => 'Mail.Ru Bot',
                'category' => 'Search bot',
                'url' => 'http://help.mail.ru/webmaster/indexing/robots/types_robots',
                'producer' => [
                    'name' => 'Mail.Ru Group',
                    'url' => 'http://corp.mail.ru',
                ],
            ],
            [
                'regex' => 'magpie-crawler',
                'name' => 'Magpie-Crawler',
                'category' => 'Social Media Agent',
                'url' => 'http://www.brandwatch.com/magpie-crawler/',
                'producer' => [
                    'name' => 'Brandwatch',
                    'url' => 'http://www.brandwatch.com',
                ],
            ],
            [
                'regex' => 'MagpieRSS',
                'name' => 'MagpieRSS',
                'url' => 'http://magpierss.sourceforge.net/',
                'category' => 'Feed Parser',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'masscan-ng\\/([\\d+.]+)',
                'name' => 'masscan-ng',
                'url' => 'https://github.com/bi-zone/masscan-ng',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'BIZON, OOO',
                    'url' => 'https://bi.zone/',
                ],
            ],
            [
                'regex' => 'masscan',
                'name' => 'masscan',
                'url' => 'https://github.com/robertdavidgraham/masscan',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'Robert Graham',
                    'url' => 'https://github.com/robertdavidgraham',
                ],
            ],
            [
                'regex' => 'Mastodon\\/',
                'name' => 'Mastodon Bot',
                'category' => 'Social Media Agent',
            ],
            [
                'regex' => 'meanpathbot',
                'name' => 'Meanpath Bot',
                'category' => 'Search bot',
                'url' => 'http://www.meanpath.com/meanpathbot.html',
                'producer' => [
                    'name' => 'Meanpath',
                    'url' => 'http://www.meanpath.com',
                ],
            ],
            [
                'regex' => 'MetaJobBot',
                'name' => 'MetaJobBot',
                'category' => 'Crawler',
                'url' => 'http://www.metajob.at/the/crawler',
                'producer' => [
                    'name' => 'MetaJob',
                    'url' => 'http://www.metajob.at',
                ],
            ],
            [
                'regex' => 'MetaInspector',
                'name' => 'MetaInspector',
                'category' => 'Crawler',
                'url' => 'https://github.com/jaimeiniesta/metainspector',
            ],
            [
                'regex' => 'MixrankBot',
                'name' => 'Mixrank Bot',
                'category' => 'Crawler',
                'url' => 'http://mixrank.com',
                'producer' => [
                    'name' => 'Online Media Group, Inc.',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'MJ12bot',
                'name' => 'MJ12 Bot',
                'category' => 'Search bot',
                'url' => 'http://majestic12.co.uk/bot.php',
                'producer' => [
                    'name' => 'Majestic-12',
                    'url' => 'http://majestic12.co.uk',
                ],
            ],
            [
                'regex' => 'Mnogosearch',
                'name' => 'Mnogosearch',
                'category' => 'Search bot',
                'url' => 'http://www.mnogosearch.org/',
                'producer' => [
                    'name' => 'Lavtech.Com Corp.',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'MojeekBot',
                'name' => 'MojeekBot',
                'category' => 'Search bot',
                'url' => 'http://www.mojeek.com/bot.html',
                'producer' => [
                    'name' => 'Mojeek Ltd.',
                    'url' => 'http://www.mojeek.com',
                ],
            ],
            [
                'regex' => 'munin',
                'name' => 'Munin',
                'category' => 'Site Monitor',
                'url' => 'http://munin-monitoring.org/',
                'producer' => [
                    'name' => 'Munin',
                    'url' => 'http://munin-monitoring.org/',
                ],
            ],
            [
                'regex' => 'NalezenCzBot',
                'name' => 'NalezenCzBot',
                'category' => 'Crawler',
                'url' => 'http://www.nalezen.cz/about-crawler',
                'producer' => [
                    'name' => 'Jaroslav Kuboš',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'check_http\\/v',
                'name' => 'Nagios check_http',
                'category' => 'Site Monitor',
                'url' => 'https://nagios.org',
                'producer' => [
                    'name' => 'Nagios Plugins Development Team',
                    'url' => 'https://nagios.org',
                ],
            ],
            [
                'regex' => 'nbertaupete95\\(at\\)gmail.com',
                'name' => 'nbertaupete95',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'Netcraft( Web Server Survey| SSL Server Survey|SurveyAgent)',
                'name' => 'Netcraft Survey Bot',
                'category' => 'Search bot',
                'url' => '',
                'producer' => [
                    'name' => 'Netcraft',
                    'url' => 'http://www.netcraft.com',
                ],
            ],
            [
                'regex' => 'netEstate NE Crawler',
                'name' => 'netEstate',
                'category' => 'Crawler',
                'url' => 'http://www.website-datenbank.de/Impressum',
                'producer' => [
                    'name' => 'netEstate GmbH',
                    'url' => 'https://www.netestate.de/en/',
                ],
            ],
            [
                'regex' => 'Netvibes',
                'name' => 'Netvibes',
                'url' => 'http://www.netvibes.com/',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'NewsBlur .*(Fetcher|Finder)',
                'name' => 'NewsBlur',
                'url' => 'http://www.newsblur.com',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'NewsGatorOnline',
                'name' => 'NewsGator',
                'url' => 'http://www.newsgator.com',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'nlcrawler',
                'name' => 'NLCrawler',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Northern Light',
                    'url' => 'http://northernlight.com',
                ],
            ],
            [
                'regex' => 'Nmap Scripting Engine',
                'name' => 'Nmap',
                'category' => 'Security Checker',
                'url' => 'https://nmap.org/book/nse.html',
                'producer' => [
                    'name' => 'Nmap',
                    'url' => 'https://nmap.org/',
                ],
            ],
            [
                'regex' => 'Nuzzel',
                'name' => 'Nuzzel',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'Nuzzel',
                    'url' => 'https://www.nuzzel.com/',
                ],
            ],
            [
                'regex' => 'Octopus [0-9]',
                'name' => 'Octopus',
            ],
            [
                'regex' => 'OnlineOrNot.com_bot',
                'name' => 'OnlineOrNot Bot',
                'category' => 'Site Monitor',
                'url' => 'https://onlineornot.com/website-monitoring',
                'producer' => [
                    'name' => 'OnlineOrNot',
                    'url' => 'https://onlineornot.com',
                ],
            ],
            [
                'regex' => 'omgili',
                'name' => 'Omgili bot',
                'category' => 'Search bot',
                'url' => 'http://www.omgili.com/Crawler.html',
                'producer' => [
                    'name' => 'Omgili',
                    'url' => 'http://www.omgili.com',
                ],
            ],
            [
                'regex' => 'OpenindexSpider',
                'name' => 'Openindex Spider',
                'category' => 'Search bot',
                'url' => 'http://www.openindex.io/en/webmasters/spider.html',
                'producer' => [
                    'name' => 'Openindex B.V.',
                    'url' => 'http://www.openindex.io',
                ],
            ],
            [
                'regex' => 'spbot',
                'name' => 'OpenLinkProfiler',
                'category' => 'Crawler',
                'url' => 'http://openlinkprofiler.org/bot',
                'producer' => [
                    'name' => 'Axandra GmbH',
                    'url' => 'http://www.axandra.com',
                ],
            ],
            [
                'regex' => 'OpenWebSpider',
                'name' => 'OpenWebSpider',
                'category' => 'Crawler',
                'url' => 'http://www.openwebspider.org',
                'producer' => [
                    'name' => 'OpenWebSpider Lab',
                    'url' => 'http://lab.openwebspider.org',
                ],
            ],
            [
                'regex' => 'OrangeBot|VoilaBot',
                'name' => 'Orange Bot',
                'category' => 'Search bot',
                'url' => 'http://lemoteur.orange.fr',
                'producer' => [
                    'name' => 'Orange',
                    'url' => 'http://www.orange.fr',
                ],
            ],
            [
                'regex' => 'PaperLiBot',
                'name' => 'PaperLiBot',
                'category' => 'Search bot',
                'url' => 'http://support.paper.li/entries/20023257-what-is-paper-li',
                'producer' => [
                    'name' => 'Smallrivers SA',
                    'url' => 'http://www.paper.li',
                ],
            ],
            [
                'regex' => 'phantomas\\/',
                'name' => 'Phantomas',
                'category' => 'Site Monitor',
                'url' => 'https://github.com/macbre/phantomas',
            ],
            [
                'regex' => 'phpservermon',
                'name' => 'PHP Server Monitor',
                'category' => 'Site Monitor',
                'url' => 'https://github.com/phpservermon/phpservermon',
                'producer' => [
                    'name' => 'PHP Server Monitor',
                    'url' => 'http://www.phpservermonitor.org/',
                ],
            ],
            [
                'regex' => 'Pocket(?:ImageCache|Parser)\\/([\\d+.]+)',
                'name' => 'Pocket',
                'category' => 'Read-it-later Service',
                'url' => 'https://getpocket.com/pocketparser_ua',
                'producer' => [
                    'name' => 'Read It Later, Inc.',
                    'url' => 'https://getpocket.com/',
                ],
            ],
            [
                'regex' => 'PritTorrent',
                'name' => 'PritTorrent',
                'category' => 'Crawler',
                'url' => 'https://github.com/astro/prittorrent',
                'producer' => [
                    'name' => 'Bitlove',
                    'url' => 'http://bitlove.org/',
                ],
            ],
            [
                'regex' => 'PRTG Network Monitor',
                'name' => 'PRTG Network Monitor',
                'category' => 'Network Monitor',
                'url' => 'https://www.paessler.com/prtg',
                'producer' => [
                    'name' => 'Paessler AG',
                    'url' => 'https://www.paessler.com',
                ],
            ],
            [
                'regex' => 'psbot',
                'name' => 'Picsearch bot',
                'category' => 'Search bot',
                'url' => 'http://www.picsearch.com/bot.html',
                'producer' => [
                    'name' => 'Picsearch',
                    'url' => 'http://www.picsearch.com',
                ],
            ],
            [
                'regex' => 'Pingdom(?:\\.com|TMS)',
                'name' => 'Pingdom Bot',
                'category' => 'Site Monitor',
                'url' => '',
                'producer' => [
                    'name' => 'Pingdom AB',
                    'url' => 'https://www.pingdom.com',
                ],
            ],
            [
                'regex' => 'Quora Link Preview',
                'name' => 'Quora Link Preview',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Quora',
                    'url' => 'http://www.quora.com',
                ],
            ],
            [
                'regex' => 'Quora-Bot',
                'name' => 'Quora Bot',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Quora',
                    'url' => 'https://www.quora.com/',
                ],
            ],
            [
                'regex' => 'RamblerMail',
                'name' => 'RamblerMail Image Proxy',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Rambler&Co',
                    'url' => 'https://rambler-co.ru/',
                ],
            ],
            [
                'regex' => 'QuerySeekerSpider',
                'name' => 'QuerySeekerSpider',
                'category' => 'Crawler',
                'url' => 'http://queryseeker.com/bot.html',
                'producer' => [
                    'name' => 'QueryEye Inc.',
                    'url' => 'http://queryeye.com',
                ],
            ],
            [
                'regex' => 'Qwantify',
                'name' => 'Qwantify',
                'category' => 'Crawler',
                'url' => 'https://www.qwant.com/',
                'producer' => [
                    'name' => 'Qwant Corporation',
                    'url' => 'https://www.qwant.com/',
                ],
            ],
            [
                'regex' => 'Rainmeter',
                'name' => 'Rainmeter',
                'category' => 'Crawler',
                'url' => 'https://www.rainmeter.net',
            ],
            [
                'regex' => 'redditbot',
                'name' => 'Reddit Bot',
                'category' => 'Social Media Agent',
                'url' => 'http://www.reddit.com/feedback',
                'producer' => [
                    'name' => 'reddit inc.',
                    'url' => 'http://www.reddit.com',
                ],
            ],
            [
                'regex' => 'Riddler',
                'name' => 'Riddler',
                'category' => 'Security search bot',
                'url' => 'https://riddler.io/about',
                'producer' => [
                    'name' => 'F-Secure',
                    'url' => 'https://www.f-secure.com',
                ],
            ],
            [
                'regex' => 'rogerbot',
                'name' => 'Rogerbot',
                'category' => 'Crawler',
                'url' => 'http://moz.com/help/pro/what-is-rogerbot-',
                'producer' => [
                    'name' => 'SEOmoz, Inc.',
                    'url' => 'http://moz.com/',
                ],
            ],
            [
                'regex' => 'ROI Hunter',
                'name' => 'ROI Hunter',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Roihunter a.s.',
                    'url' => 'http://roihunter.com/',
                ],
            ],
            [
                'regex' => 'SafeDNSBot',
                'name' => 'SafeDNSBot',
                'category' => 'Crawler',
                'url' => 'https://www.safedns.com/searchbot',
                'producer' => [
                    'name' => 'SafeDNS, Inc.',
                    'url' => 'https://www.safedns.com/',
                ],
            ],
            [
                'regex' => 'Scrapy',
                'name' => 'Scrapy',
                'category' => 'Crawler',
                'url' => 'http://scrapy.org',
            ],
            [
                'regex' => 'Screaming Frog SEO Spider',
                'name' => 'Screaming Frog SEO Spider',
                'category' => 'Crawler',
                'url' => 'http://www.screamingfrog.co.uk/seo-spider',
                'producer' => [
                    'name' => 'Screaming Frog Ltd',
                    'url' => 'http://www.screamingfrog.co.uk',
                ],
            ],
            [
                'regex' => 'ScreenerBot',
                'name' => 'ScreenerBot',
                'category' => 'Crawler',
                'url' => 'http://www.screenerbot.com',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'SemrushBot',
                'name' => 'Semrush Bot',
                'category' => 'Crawler',
                'url' => 'http://www.semrush.com/bot.html',
                'producer' => [
                    'name' => 'SEMrush',
                    'url' => 'http://www.semrush.com',
                ],
            ],
            [
                'regex' => 'SensikaBot',
                'name' => 'Sensika Bot',
                'category' => '',
                'url' => '',
                'producer' => [
                    'name' => 'Sensika',
                    'url' => 'http://sensika.com',
                ],
            ],
            [
                'regex' => 'SEOENG(World)?Bot',
                'name' => 'SEOENGBot',
                'category' => 'Crawler',
                'url' => 'http://www.seoengine.com/seoengbot.htm',
                'producer' => [
                    'name' => 'SEO Engine',
                    'url' => 'http://www.seoengine.com',
                ],
            ],
            [
                'regex' => 'SEOkicks-Robot',
                'name' => 'SEOkicks-Robot',
                'category' => 'Crawler',
                'url' => 'http://www.seokicks.de/robot.html',
                'producer' => [
                    'name' => 'SEOkicks',
                    'url' => 'https://www.seokicks.de/',
                ],
            ],
            [
                'regex' => 'seoscanners\\.net',
                'name' => 'Seoscanners.net',
                'category' => 'Crawler',
                'url' => '',
            ],
            [
                'regex' => 'SkypeUriPreview',
                'name' => 'Skype URI Preview',
                'category' => 'Service Agent',
                'url' => '',
                'producer' => [
                    'name' => 'Skype Communications S.à.r.l.',
                    'url' => 'https://www.skype.com',
                ],
            ],
            [
                'regex' => 'SeznamBot|SklikBot|Seznam screenshot-generator',
                'name' => 'Seznam Bot',
                'category' => 'Search bot',
                'url' => 'http://www.mapy.cz/cz/seznambot.html',
                'producer' => [
                    'name' => 'Seznam.cz, a.s.',
                    'url' => 'http://www.seznam.cz/',
                ],
            ],
            [
                'regex' => 'shopify-partner-homepage-scraper',
                'name' => 'Shopify Partner',
                'category' => 'Crawler',
                'url' => 'https://www.shopify.com/partners',
                'producer' => [
                    'name' => 'Shopify',
                    'url' => 'https://www.shopify.com/',
                ],
            ],
            [
                'regex' => 'ShopWiki',
                'name' => 'ShopWiki',
                'category' => 'Search tools',
                'url' => 'http://www.shopwiki.com/wiki/Help:Bot',
                'producer' => [
                    'name' => 'ShopWiki Corp.',
                    'url' => 'http://www.shopwiki.com',
                ],
            ],
            [
                'regex' => 'SilverReader',
                'name' => 'SilverReader',
                'url' => 'http://silverreader.com',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'SimplePie',
                'name' => 'SimplePie',
                'url' => 'http://www.simplepie.org',
                'category' => 'Feed Parser',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'SISTRIX Crawler',
                'name' => 'SISTRIX Crawler',
                'category' => 'Crawler',
                'url' => 'http://crawler.sistrix.net',
                'producer' => [
                    'name' => 'SISTRIX GmbH',
                    'url' => 'http://www.sistrix.de',
                ],
            ],
            [
                'regex' => 'compatible; (?:SISTRIX )?Optimizer',
                'name' => 'SISTRIX Optimizer',
                'category' => 'Crawler',
                'url' => 'https://optimizer.sistrix.com',
                'producer' => [
                    'name' => 'SISTRIX GmbH',
                    'url' => 'http://www.sistrix.de',
                ],
            ],
            [
                'regex' => 'SiteSucker',
                'name' => 'SiteSucker',
                'category' => 'Crawler',
                'url' => 'http://ricks-apps.com/osx/sitesucker/',
            ],
            [
                'regex' => 'sixy.ch',
                'name' => 'Sixy.ch',
                'category' => 'Site Monitor',
                'url' => 'http://sixy.ch',
                'producer' => [
                    'name' => 'Manuel Kasper',
                    'url' => 'https://neon1.net/',
                ],
            ],
            [
                'regex' => 'Slackbot|Slack-ImgProxy',
                'name' => 'Slackbot',
                'category' => 'Crawler',
                'url' => 'https://api.slack.com/robots',
                'producer' => [
                    'name' => 'Slack Technologies',
                    'url' => 'http://slack.com',
                ],
            ],
            [
                'regex' => '(Sogou[ -](head|inst|Orion|Pic|Test|web)[ -]spider)|New-Sogou-Spider',
                'name' => 'Sogou Spider',
                'category' => 'Search bot',
                'url' => 'http://www.sogou.com/docs/help/webmasters.htm',
                'producer' => [
                    'name' => 'Sohu, Inc.',
                    'url' => 'http://www.sogou.com',
                ],
            ],
            [
                'regex' => 'Sosospider|Sosoimagespider',
                'name' => 'Soso Spider',
                'category' => 'Search bot',
                'url' => 'http://help.soso.com/webspider.htm',
                'producer' => [
                    'name' => 'Tencent Holdings',
                    'url' => 'http://www.soso.com',
                ],
            ],
            [
                'regex' => 'Sprinklr',
                'name' => 'Sprinklr',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Sprinklr, Inc.',
                    'url' => 'https://www.sprinklr.com/',
                ],
            ],
            [
                'regex' => 'sqlmap\\/',
                'name' => 'sqlmap',
                'category' => 'Security Checker',
                'url' => 'http://sqlmap.org/',
                'producer' => [
                    'name' => 'sqlmap',
                    'url' => 'http://sqlmap.org/',
                ],
            ],
            [
                'regex' => 'SSL Labs',
                'name' => 'SSL Labs',
                'category' => 'Validator',
                'url' => 'https://www.ssllabs.com/about/assessment.html',
                'producer' => [
                    'name' => 'SSL Labs',
                    'url' => 'https://www.ssllabs.com/about/assessment.html',
                ],
            ],
            [
                'regex' => 'StatusCake',
                'name' => 'StatusCake',
                'category' => 'Site Monitor',
                'url' => 'https://www.statuscake.com',
                'producer' => [
                    'name' => 'StatusCake',
                    'url' => 'https://www.statuscake.com',
                ],
            ],
            [
                'regex' => 'Superfeedr bot',
                'name' => 'Superfeedr Bot',
                'category' => 'Feed Fetcher',
                'url' => '',
                'producer' => [
                    'name' => 'Superfeedr',
                    'url' => 'https://superfeedr.com/',
                ],
            ],
            [
                'regex' => 'Sparkler\\/[0-9]',
                'name' => 'Sparkler',
                'category' => 'Crawler',
                'url' => 'https://github.com/USCDataScience/sparkler',
            ],
            [
                'regex' => 'Spinn3r',
                'name' => 'Spinn3r',
                'category' => 'Crawler',
                'url' => 'http://spinn3r.com/robot',
                'producer' => [
                    'name' => 'Tailrank Inc',
                    'url' => 'http://spinn3r.com',
                ],
            ],
            [
                'regex' => 'SputnikBot',
                'name' => 'Sputnik Bot',
                'category' => 'Crawler',
                'url' => '',
            ],
            [
                'regex' => 'SputnikFaviconBot',
                'name' => 'Sputnik Favicon Bot',
                'category' => 'Crawler',
                'url' => '',
            ],
            [
                'regex' => 'SputnikImageBot',
                'name' => 'Sputnik Image Bot',
                'category' => 'Crawler',
                'url' => '',
            ],
            [
                'regex' => 'SurveyBot',
                'name' => 'Survey Bot',
                'category' => 'Search bot',
                'url' => 'http://www.domaintools.com/webmasters/surveybot.php',
                'producer' => [
                    'name' => 'Domain Tools',
                    'url' => 'http://www.domaintools.com',
                ],
            ],
            [
                'regex' => 'TarmotGezgin',
                'name' => 'Tarmot Gezgin',
                'url' => 'http://www.tarmot.com/gezgin/',
                'category' => 'Search bot',
            ],
            [
                'regex' => 'TelegramBot',
                'name' => 'TelegramBot',
                'url' => 'https://telegram.org/blog/bot-revolution',
            ],
            [
                'regex' => 'TLSProbe',
                'name' => 'TLSProbe',
                'url' => 'https://scan.trustnet.venafi.com/',
                'category' => 'Security search bot',
                'producer' => [
                    'name' => 'Venafi TrustNet',
                    'url' => 'https://www.venafi.com',
                ],
            ],
            [
                'regex' => 'TinEye-bot',
                'name' => 'TinEye Crawler',
                'category' => 'Search bot',
                'url' => 'http://www.tineye.com/crawler.html',
                'producer' => [
                    'name' => 'Idée Inc.',
                    'url' => 'http://ideeinc.com',
                ],
            ],
            [
                'regex' => 'Tiny Tiny RSS',
                'name' => 'Tiny Tiny RSS',
                'url' => 'http://tt-rss.org',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'theoldreader.com',
                'name' => 'theoldreader',
                'category' => 'Feed Reader',
                'url' => 'https://theoldreader.com',
            ],
            [
                'regex' => 'trendictionbot',
                'name' => 'Trendiction Bot',
                'category' => 'Crawler',
                'url' => 'http://www.trendiction.de/bot',
                'producer' => [
                    'name' => 'Talkwalker Inc.',
                    'url' => 'http://www.talkwalker.com',
                ],
            ],
            [
                'regex' => 'TurnitinBot',
                'name' => 'TurnitinBot',
                'category' => 'Crawler',
                'url' => 'http://www.turnitin.com/robot/crawlerinfo.html',
                'producer' => [
                    'name' => 'iParadigms, LLC.',
                    'url' => 'http://www.turnitin.com',
                ],
            ],
            [
                'regex' => 'TweetedTimes Bot',
                'name' => 'TweetedTimes Bot',
                'category' => 'Crawler',
                'url' => 'http://tweetedtimes.com',
                'producer' => [
                    'name' => 'TweetedTimes',
                    'url' => 'http://tweetedtimes.com/',
                ],
            ],
            [
                'regex' => 'TweetmemeBot',
                'name' => 'Tweetmeme Bot',
                'category' => 'Crawler',
                'url' => 'http://tweetmeme.com/',
                'producer' => [
                    'name' => 'Mediasift',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Twingly Recon',
                'name' => 'Twingly Recon',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'Twingly',
                    'url' => 'https://www.twingly.com',
                ],
            ],
            [
                'regex' => 'Twitterbot',
                'name' => 'Twitterbot',
                'category' => 'Social Media Agent',
                'url' => 'https://dev.twitter.com/docs/cards/getting-started',
                'producer' => [
                    'name' => 'Twitter',
                    'url' => 'http://www.twitter.com',
                ],
            ],
            [
                'regex' => 'UniversalFeedParser',
                'name' => 'UniversalFeedParser',
                'category' => 'Feed Fetcher',
                'url' => 'https://github.com/kurtmckee/feedparser',
                'producer' => [
                    'name' => 'Kurt McKee',
                    'url' => 'https://github.com/kurtmckee',
                ],
            ],
            [
                'regex' => 'via secureurl\\.fwdcdn\\.com',
                'name' => 'UkrNet Mail Proxy',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'UkrNet Ltd',
                    'url' => 'https://www.ukr.net/',
                ],
            ],
            [
                'regex' => 'Uptimebot',
                'name' => 'Uptimebot',
                'category' => 'Site Monitor',
                'url' => 'https://uptime.com/uptimebot',
                'producer' => [
                    'name' => 'Uptime',
                    'url' => 'https://uptime.com',
                ],
            ],
            [
                'regex' => 'UptimeRobot',
                'name' => 'Uptime Robot',
                'category' => 'Site Monitor',
                'url' => '',
                'producer' => [
                    'name' => 'Uptime Robot',
                    'url' => 'http://uptimerobot.com',
                ],
            ],
            [
                'regex' => 'URLAppendBot',
                'name' => 'URLAppendBot',
                'category' => 'Crawler',
                'url' => 'http://www.profound.net/urlappendbot.html',
                'producer' => [
                    'name' => 'Profound Networks',
                    'url' => 'http://www.profound.net',
                ],
            ],
            [
                'regex' => 'Vagabondo',
                'name' => 'Vagabondo',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'WiseGuys',
                    'url' => 'http://www.wise-guys.nl/',
                ],
            ],
            [
                'regex' => 'vkShare; ',
                'name' => 'VK Share Button',
                'category' => 'Crawler',
                'url' => 'http://vk.com/dev/Share',
                'producer' => [
                    'name' => 'VK',
                    'url' => 'http://vk.com/',
                ],
            ],
            [
                'regex' => 'VSMCrawler',
                'name' => 'Visual Site Mapper Crawler',
                'category' => 'Crawler',
                'url' => 'http://www.visualsitemapper.com/crawler',
                'producer' => [
                    'name' => 'Alentum Software Ltd.',
                    'url' => 'http://www.alentum.com',
                ],
            ],
            [
                'regex' => 'Jigsaw',
                'name' => 'W3C CSS Validator',
                'category' => 'Validator',
                'url' => 'http://jigsaw.w3.org/css-validator',
                'producer' => [
                    'name' => 'W3C',
                    'url' => 'http://www.w3.org',
                ],
            ],
            [
                'regex' => 'W3C_I18n-Checker',
                'name' => 'W3C I18N Checker',
                'category' => 'Validator',
                'url' => 'http://validator.w3.org/i18n-checker',
                'producer' => [
                    'name' => 'W3C',
                    'url' => 'http://www.w3.org',
                ],
            ],
            [
                'regex' => 'W3C-checklink',
                'name' => 'W3C Link Checker',
                'category' => 'Validator',
                'url' => 'http://validator.w3.org/checklink',
                'producer' => [
                    'name' => 'W3C',
                    'url' => 'http://www.w3.org',
                ],
            ],
            [
                'regex' => 'W3C_Validator|Validator.nu',
                'name' => 'W3C Markup Validation Service',
                'category' => 'Validator',
                'url' => 'http://validator.w3.org/services',
                'producer' => [
                    'name' => 'W3C',
                    'url' => 'http://www.w3.org',
                ],
            ],
            [
                'regex' => 'W3C-mobileOK',
                'name' => 'W3C MobileOK Checker',
                'category' => 'Validator',
                'url' => 'http://validator.w3.org/mobile',
                'producer' => [
                    'name' => 'W3C',
                    'url' => 'http://www.w3.org',
                ],
            ],
            [
                'regex' => 'W3C_Unicorn',
                'name' => 'W3C Unified Validator',
                'category' => 'Validator',
                'url' => 'http://validator.w3.org/unicorn',
                'producer' => [
                    'name' => 'W3C',
                    'url' => 'http://www.w3.org',
                ],
            ],
            [
                'regex' => 'Wappalyzer',
                'name' => 'Wappalyzer',
                'url' => 'https://github.com/AliasIO/Wappalyzer',
                'producer' => [
                    'name' => 'AliasIO',
                    'url' => 'https://github.com/AliasIO',
                ],
            ],
            [
                'regex' => 'PTST\\/',
                'name' => 'WebPageTest',
                'category' => 'Site Monitor',
                'url' => 'https://www.webpagetest.org',
            ],
            [
                'regex' => 'WeSEE',
                'name' => 'WeSEE:Search',
                'category' => 'Search bot',
                'url' => 'http://www.wesee.com/bot',
                'producer' => [
                    'name' => 'WeSEE Ltd',
                    'url' => 'http://www.wesee.com',
                ],
            ],
            [
                'regex' => 'WebbCrawler',
                'name' => 'WebbCrawler',
                'category' => 'Crawler',
                'url' => 'http://badcheese.com/crawler.html',
                'producer' => [
                    'name' => 'Steve Webb',
                    'url' => 'http://badcheese.com',
                ],
            ],
            [
                'regex' => 'websitepulse[+ ]checker',
                'name' => 'WebSitePulse',
                'category' => 'Site Monitor',
                'url' => 'http://badcheese.com/crawler.html',
                'producer' => [
                    'name' => 'WebSitePulse',
                    'url' => 'http://www.websitepulse.com/',
                ],
            ],
            [
                'regex' => 'WordPress',
                'name' => 'WordPress',
                'category' => 'Service Agent',
                'url' => 'https://wordpress.org/',
                'producer' => [
                    'name' => 'Wordpress.org',
                    'url' => 'https://wordpress.org/',
                ],
            ],
            [
                'regex' => 'Wotbox',
                'name' => 'Wotbox',
                'category' => 'Search bot',
                'url' => 'http://www.wotbox.com/bot/',
                'producer' => [
                    'name' => 'Wotbox',
                    'url' => 'http://www.wotbox.com',
                ],
            ],
            [
                'regex' => 'XenForo',
                'name' => 'XenForo',
                'category' => 'Service Agent',
                'url' => 'https://xenforo.com/',
                'producer' => [
                    'name' => 'XenForo Ltd.',
                    'url' => 'https://xenforo.com/',
                ],
            ],
            [
                'regex' => 'yacybot',
                'name' => 'YaCy',
                'category' => 'Search bot',
                'url' => 'http://yacy.net/bot.html',
                'producer' => [
                    'name' => 'YaCy',
                    'url' => 'http://yacy.net',
                ],
            ],
            [
                'regex' => 'Yahoo! Slurp|Yahoo!-AdCrawler',
                'name' => 'Yahoo! Slurp',
                'category' => 'Search bot',
                'url' => 'http://help.yahoo.com/ysearch/slurp',
                'producer' => [
                    'name' => 'Yahoo! Inc.',
                    'url' => 'http://www.yahoo.com',
                ],
            ],
            [
                'regex' => 'Yahoo Link Preview|Yahoo:LinkExpander:Slingstone',
                'name' => 'Yahoo! Link Preview',
                'category' => 'Crawler',
                'url' => 'https://help.yahoo.com/kb/mail/yahoo-link-preview-SLN23615.html',
                'producer' => [
                    'name' => 'Yahoo! Inc.',
                    'url' => 'http://www.yahoo.com',
                ],
            ],
            [
                'regex' => 'YahooMailProxy',
                'name' => 'Yahoo! Mail Proxy',
                'category' => 'Service Agent',
                'url' => 'https://help.yahoo.com/kb/yahoo-mail-proxy-SLN28749.html',
                'producer' => [
                    'name' => 'Yahoo! Inc.',
                    'url' => 'http://www.yahoo.com',
                ],
            ],
            [
                'regex' => 'YahooCacheSystem',
                'name' => 'Yahoo! Cache System',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Yahoo! Inc.',
                    'url' => 'http://www.yahoo.com',
                ],
            ],
            [
                'regex' => 'Y!J-BRW',
                'name' => 'Yahoo! Japan BRW',
                'category' => 'Crawler',
                'url' => 'https://support.yahoo-net.jp/PccSearch/s/article/H000007955',
                'producer' => [
                    'name' => 'Yahoo! Japan Corp.',
                    'url' => 'https://www.yahoo.co.jp/',
                ],
            ],
            [
                'regex' => 'Y!J-WSC',
                'name' => 'Yahoo! Japan WSC',
                'category' => 'Crawler',
                'url' => 'https://support.yahoo-net.jp/PccSearch/s/article/H000007955',
                'producer' => [
                    'name' => 'Yahoo! Japan Corp.',
                    'url' => 'https://www.yahoo.co.jp/',
                ],
            ],
            [
                'regex' => 'Yandex(SpravBot|ScreenshotBot|MobileBot|AccessibilityBot|ForDomain|Vertis|Market|Catalog|Calendar|Sitelinks|AdNet|Pagechecker|Webmaster|Media|Video|Bot|Images|Antivirus|Direct|Blogs|Favicons|ImageResizer|Verticals|News|Metrika|\\.Gazeta Bot)|YaDirectFetcher|YandexTurbo|YandexTracker|YandexSearchShop|YandexRCA|YandexPartner|YandexOntoDBAPI|YandexOntoDB|YandexMobileScreenShotBot',
                'name' => 'Yandex Bot',
                'category' => 'Search bot',
                'url' => 'http://www.yandex.com/bots',
                'producer' => [
                    'name' => 'Yandex LLC',
                    'url' => 'http://company.yandex.com',
                ],
            ],
            [
                'regex' => 'Yeti|NaverJapan|AdsBot-Naver',
                'name' => 'Yeti/Naverbot',
                'category' => 'Search bot',
                'url' => 'http://help.naver.com/robots/',
                'producer' => [
                    'name' => 'Naver',
                    'url' => 'http://www.naver.com',
                ],
            ],
            [
                'regex' => 'YoudaoBot',
                'name' => 'Youdao Bot',
                'category' => 'Search bot',
                'url' => 'http://www.youdao.com/help/webmaster/spider',
                'producer' => [
                    'name' => 'NetEase, Inc.',
                    'url' => 'http://corp.163.com',
                ],
            ],
            [
                'regex' => 'YOURLS v[0-9]',
                'name' => 'Yourls',
                'category' => 'Crawler',
                'url' => 'http://yourls.org',
            ],
            [
                'regex' => 'YRSpider|YYSpider',
                'name' => 'Yunyun Bot',
                'category' => 'Search bot',
                'url' => 'http://www.yunyun.com/SiteInfo.php?r=about',
                'producer' => [
                    'name' => 'YunYun',
                    'url' => 'http://www.yunyun.com',
                ],
            ],
            [
                'regex' => 'zgrab',
                'name' => 'zgrab',
                'category' => 'Security Checker',
                'url' => 'https://github.com/zmap/zgrab',
            ],
            [
                'regex' => 'Zookabot',
                'name' => 'Zookabot',
                'category' => 'Crawler',
                'url' => 'http://zookabot.com',
                'producer' => [
                    'name' => 'Hwacha ApS',
                    'url' => 'http://hwacha.dk',
                ],
            ],
            [
                'regex' => 'ZumBot',
                'name' => 'ZumBot',
                'category' => 'Search bot',
                'url' => 'http://help.zum.com/inquiry',
                'producer' => [
                    'name' => 'ZUM internet',
                    'url' => 'http://www.zuminternet.com/',
                ],
            ],
            [
                'regex' => 'YottaaMonitor',
                'name' => 'Yottaa Site Monitor',
                'category' => 'Site Monitor',
                'url' => 'http://www.yottaa.com/products/site-monitor',
                'producer' => [
                    'name' => 'Yottaa',
                    'url' => 'http://www.yottaa.com/',
                ],
            ],
            [
                'regex' => 'Yahoo Ad monitoring.*yahoo-ad-monitoring-SLN24857.*',
                'name' => 'Yahoo Gemini',
                'category' => 'Crawler',
                'url' => 'https://help.yahoo.com/kb/yahoo-ad-monitoring-SLN24857.html',
                'producer' => [
                    'name' => 'Yahoo! Inc.',
                    'url' => 'http://www.yahoo.com',
                ],
            ],
            [
                'regex' => '.*Java.*outbrain',
                'name' => 'Outbrain',
                'category' => 'Crawler',
                'url' => '',
                'producer' => [
                    'name' => 'Outbrain',
                    'url' => 'http://www.outbrain.com/',
                ],
            ],
            [
                'regex' => 'HubPages.*crawlingpolicy',
                'name' => 'HubPages',
                'category' => 'Crawler',
                'url' => 'https://hubpages.com/help/crawlingpolicy',
                'producer' => [
                    'name' => 'HubPages, Inc.',
                    'url' => 'https://discover.hubpages.com/',
                ],
            ],
            [
                'regex' => 'Pinterest(bot)?\\/\\d\\.\\d.*www\\.pinterest\\.com.*',
                'name' => 'Pinterest',
                'url' => 'https://help.pinterest.com/en/business/article/pinterest-crawler',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'Pinterest',
                    'url' => 'https://www.pinterest.com/',
                ],
            ],
            [
                'regex' => 'Site24x7',
                'name' => 'Site24x7 Website Monitoring',
                'category' => 'Site Monitor',
                'url' => 'https://www.site24x7.com/site24x7-faq.html',
                'producer' => [
                    'name' => 'Site24x7',
                    'url' => 'https://www.site24x7.com',
                ],
            ],
            [
                'regex' => 's~snapchat-proxy',
                'name' => 'Snapchat Proxy',
                'category' => 'Crawler',
                'url' => 'https://www.snapchat.com',
                'producer' => [
                    'name' => 'Snapchat Inc.',
                    'url' => 'https://www.snapchat.com',
                ],
            ],
            [
                'regex' => 'Snap URL Preview Service',
                'name' => 'Snap URL Preview Service',
                'category' => 'Service Agent',
                'url' => 'https://developers.snap.com/robots',
                'producer' => [
                    'name' => 'Snapchat Inc.',
                    'url' => 'https://www.snapchat.com/',
                ],
            ],
            [
                'regex' => 'Let\'s Encrypt validation server',
                'name' => 'Let\'s Encrypt Validation',
                'category' => 'Service Agent',
                'url' => 'https://letsencrypt.org/how-it-works/',
                'producer' => [
                    'name' => 'Let\'s Encrypt',
                    'url' => 'https://letsencrypt.org',
                ],
            ],
            [
                'regex' => 'GrapeshotCrawler',
                'name' => 'Grapeshot',
                'category' => 'Crawler',
                'url' => 'https://www.grapeshot.com/crawler',
                'producer' => [
                    'name' => 'Grapeshot',
                    'url' => 'https://www.grapeshot.com',
                ],
            ],
            [
                'regex' => 'www\\.monitor\\.us',
                'name' => 'Monitor.Us',
                'category' => 'Site Monitor',
                'url' => 'http://www.monitor.us',
                'producer' => [
                    'name' => 'Monitor.Us',
                    'url' => 'http://www.monitor.us',
                ],
            ],
            [
                'regex' => 'Catchpoint',
                'name' => 'Catchpoint',
                'category' => 'Site Monitor',
                'url' => 'https://www.catchpoint.com/',
                'producer' => [
                    'name' => 'Catchpoint Systems',
                    'url' => 'https://www.catchpoint.com/',
                ],
            ],
            [
                'regex' => 'bitlybot',
                'name' => 'BitlyBot',
                'category' => 'Crawler',
                'url' => 'https://bitly.com',
                'producer' => [
                    'name' => 'Bitly, Inc.',
                    'url' => 'https://bitly.com',
                ],
            ],
            [
                'regex' => 'Zao\\/',
                'name' => 'Zao',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'lycos',
                'name' => 'Lycos',
            ],
            [
                'regex' => 'Slurp',
                'name' => 'Inktomi Slurp',
            ],
            [
                'regex' => 'Speedy Spider',
                'name' => 'Speedy',
            ],
            [
                'regex' => 'ScoutJet',
                'name' => 'ScoutJet',
            ],
            [
                'regex' => 'nrsbot|netresearch',
                'name' => 'NetResearchServer',
            ],
            [
                'regex' => 'scooter',
                'name' => 'Scooter',
            ],
            [
                'regex' => 'gigabot',
                'name' => 'Gigabot',
            ],
            [
                'regex' => 'charlotte',
                'name' => 'Charlotte',
            ],
            [
                'regex' => 'Pompos',
                'name' => 'Pompos',
            ],
            [
                'regex' => 'ichiro',
                'name' => 'ichiro',
            ],
            [
                'regex' => 'PagePeeker',
                'name' => 'PagePeeker',
            ],
            [
                'regex' => 'WebThumbnail',
                'name' => 'WebThumbnail',
            ],
            [
                'regex' => 'Willow Internet Crawler',
                'name' => 'Willow Internet Crawler',
            ],
            [
                'regex' => 'EmailWolf',
                'name' => 'EmailWolf',
            ],
            [
                'regex' => 'NetLyzer FastProbe',
                'name' => 'NetLyzer FastProbe',
            ],
            [
                'regex' => 'AdMantX.*admantx\\.com',
                'name' => 'ADMantX',
            ],
            [
                'regex' => 'Server Density Service Monitoring.*',
                'name' => 'Server Density',
            ],
            [
                'regex' => 'RSSRadio \\(Push Notification Scanner;support@dorada\\.co\\.uk\\)',
                'name' => 'RSSRadio Bot',
            ],
            [
                'regex' => '(A6-Indexer|nuhk|TsolCrawler|Yammybot|Openbot|Gulper Web Bot|grub-client|Download Demon|SearchExpress|Microsoft URL Control|borg|altavista|dataminr.com|tweetedtimes.com|TrendsmapResolver|teoma|blitzbot|oegp|furlbot|http%20client|polybot|htdig|mogimogi|larbin|scrubby|searchsight|seekbot|semanticdiscovery|snappy|vortex(?!(?: Build|Plus))|zeal(?!ot)|fast-webcrawler|converacrawler|dataparksearch|findlinks|BrowserMob|HttpMonitor|ThumbShotsBot|URL2PNG|ZooShot|GomezA|Google SketchUp|Read%20Later|RackspaceBot|robots|SeopultContentAnalyzer|7Siters|centuryb.o.t9|InterNaetBoten|EasyBib AutoCite|Bidtellect|tomnomnom\/meg|My User Agent|cortex|CF-UC User Agent|Re-re Studio|adreview|AHC\/|NameOfAgent|Request-Promise|ALittle Client|Hello,? world|wp_is_mobile|0xAbyssalDoesntExist|Anarchy99|daumoa,damoa,daum,daumos,duamoa,duam,duamos|^revolt|nvd0rz|xfa1|Hakai|gbrmss|fuck-your-hp|IDBTE4M CODE87|Antoine|Insomania|Hells-Net|b3astmode|Linux Gnu \\(cow\\)|custom_user_agent|Test Certificate Info|iplabel|Magellan)',
                'name' => 'Generic Bot',
            ],
            [
                'regex' => '^sentry',
                'name' => 'Sentry Bot',
                'producer' => [
                    'name' => 'Sentry',
                    'url' => 'https://sentry.io',
                ],
            ],
            [
                'regex' => '^Spotify\\/(\\d+[\\.\\d]+)$',
                'name' => 'Spotify',
                'producer' => [
                    'name' => 'Spotify',
                    'url' => 'https://www.spotify.com',
                ],
            ],
            [
                'regex' => 'The Knowledge AI',
                'name' => 'The Knowledge AI',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'Embedly',
                'name' => 'Embedly',
                'category' => 'Crawler',
                'url' => 'https://support.embed.ly/hc/en-us',
                'producer' => [
                    'name' => 'A Medium, Corp.',
                    'url' => 'https://medium.com/',
                ],
            ],
            [
                'regex' => 'BrandVerity',
                'name' => 'BrandVerity',
                'category' => 'Crawler',
                'url' => 'https://www.brandverity.com/why-is-brandverity-visiting-me',
                'producer' => [
                    'name' => 'BrandVerity, Inc.',
                    'url' => 'https://www.brandverity.com/',
                ],
            ],
            [
                'regex' => 'Kaspersky Lab CFR link resolver',
                'name' => 'Kaspersky',
                'category' => 'Security Checker',
                'url' => 'https://www.kaspersky.com/',
                'producer' => [
                    'name' => 'AO Kaspersky Lab',
                    'url' => 'https://www.kaspersky.com/',
                ],
            ],
            [
                'regex' => 'eZ Publish Link Validator',
                'name' => 'eZ Publish Link Validator',
                'category' => 'Crawler',
                'url' => 'https://ez.no/',
                'producer' => [
                    'name' => 'eZ Systems AS',
                    'url' => 'https://ez.no/',
                ],
            ],
            [
                'regex' => 'woorankreview',
                'name' => 'WooRank',
                'category' => 'Search bot',
                'url' => 'https://www.woorank.com/',
                'producer' => [
                    'name' => 'WooRank sprl',
                    'url' => 'https://www.woorank.com/',
                ],
            ],
            [
                'regex' => 'by Siteimprove\\.com',
                'name' => 'Siteimprove',
                'category' => 'Search bot',
                'url' => 'https://siteimprove.com/',
                'producer' => [
                    'name' => 'Siteimprove GmbH',
                    'url' => 'https://siteimprove.com/',
                ],
            ],
            [
                'regex' => 'Image size by Siteimprove\\.com',
                'name' => 'Siteimprove',
                'category' => 'Search bot',
                'url' => 'https://siteimprove.com/',
                'producer' => [
                    'name' => 'Siteimprove GmbH',
                    'url' => 'https://siteimprove.com/',
                ],
            ],
            [
                'regex' => 'CATExplorador',
                'name' => 'CATExplorador',
                'category' => 'Search bot',
                'url' => 'https://fundacio.cat/ca/domini/',
                'producer' => [
                    'name' => 'Fundació puntCAT',
                    'url' => 'https://fundacio.cat/ca/domini/',
                ],
            ],
            [
                'regex' => 'Buck',
                'name' => 'Buck',
                'category' => 'Search bot',
                'url' => 'https://hypefactors.com/',
                'producer' => [
                    'name' => 'Hypefactors A/S',
                    'url' => 'https://hypefactors.com/',
                ],
            ],
            [
                'regex' => 'tracemyfile',
                'name' => 'TraceMyFile',
                'category' => 'Search bot',
                'url' => 'https://www.tracemyfile.com/',
                'producer' => [
                    'name' => 'Idee Inc.',
                    'url' => 'http://ideeinc.com/',
                ],
            ],
            [
                'regex' => 'zelist.ro feed parser',
                'name' => 'Ze List',
                'url' => 'https://www.zelist.ro/',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => 'Treeworks SRL',
                    'url' => 'https://www.tree.ro/',
                ],
            ],
            [
                'regex' => 'weborama-fetcher',
                'name' => 'Weborama',
                'category' => 'Search bot',
                'url' => 'https://weborama.com/',
                'producer' => [
                    'name' => 'Weborama SA',
                    'url' => 'https://weborama.com/',
                ],
            ],
            [
                'regex' => 'BoardReader Favicon Fetcher',
                'name' => 'BoardReader',
                'category' => 'Search bot',
                'url' => 'https://boardreader.com/',
                'producer' => [
                    'name' => 'Effyis Inc',
                    'url' => 'https://boardreader.com/',
                ],
            ],
            [
                'regex' => 'IDG\\/IT',
                'name' => 'IDG/IT',
                'category' => 'Search bot',
                'url' => 'https://spaziodati.eu/',
                'producer' => [
                    'name' => 'SpazioDati S.r.l.',
                    'url' => 'https://spaziodati.eu/',
                ],
            ],
            [
                'regex' => 'Bytespider',
                'name' => 'Bytespider',
                'category' => 'Search bot',
                'url' => 'https://bytedance.com/',
                'producer' => [
                    'name' => 'ByteDance Ltd.',
                    'url' => 'https://bytedance.com/',
                ],
            ],
            [
                'regex' => 'WikiDo',
                'name' => 'WikiDo',
                'category' => 'Search bot',
                'url' => 'https://www.wikido.com/',
                'producer' => [
                    'name' => 'Fotolitografie Fiorentine di Becchi Antonio s.n.c.',
                    'url' => 'https://www.wikido.com/',
                ],
            ],
            [
                'regex' => 'AwarioSmartBot',
                'name' => 'Awario',
                'category' => 'Search bot',
                'url' => 'https://awario.com/bots.html',
                'producer' => [
                    'name' => 'Awario',
                    'url' => 'https://awario.com/',
                ],
            ],
            [
                'regex' => 'AwarioRssBot',
                'name' => 'Awario',
                'category' => 'Feed Fetcher',
                'url' => 'https://awario.com/bots.html',
                'producer' => [
                    'name' => 'Awario',
                    'url' => 'https://awario.com/',
                ],
            ],
            [
                'regex' => 'oBot',
                'name' => 'oBot',
                'category' => 'Search bot',
                'url' => 'https://www.xforce-security.com/crawler/',
                'producer' => [
                    'name' => 'IBM Germany Research & Development GmbH',
                    'url' => 'https://exchange.xforce.ibmcloud.com/',
                ],
            ],
            [
                'regex' => 'SMTBot',
                'name' => 'SMTBot',
                'category' => 'Search bot',
                'url' => 'https://www.similartech.com/smtbot',
                'producer' => [
                    'name' => 'SimilarTech Ltd.',
                    'url' => 'https://www.similartech.com/',
                ],
            ],
            [
                'regex' => 'LCC',
                'name' => 'LCC',
                'category' => 'Search bot',
                'url' => 'https://corpora.uni-leipzig.de/crawler_faq.html',
                'producer' => [
                    'name' => 'Universität Leipzig',
                    'url' => 'https://www.uni-leipzig.de/',
                ],
            ],
            [
                'regex' => 'Startpagina-Linkchecker',
                'name' => 'Startpagina Linkchecker',
                'category' => 'Search bot',
                'url' => 'https://www.startpagina.nl/linkchecker',
                'producer' => [
                    'name' => 'Startpagina B.V.',
                    'url' => 'https://www.startpagina.nl/',
                ],
            ],
            [
                'regex' => 'MoodleBot-Linkchecker',
                'name' => 'MoodleBot Linkchecker',
                'category' => 'Search bot',
                'url' => 'hhttps://docs.moodle.org/en/Usage',
                'producer' => [
                    'name' => 'Moodle Pty Ltd',
                    'url' => 'https://moodle.org/',
                ],
            ],
            [
                'regex' => 'GTmetrix',
                'name' => 'GTmetrix',
                'category' => 'Crawler',
                'url' => 'https://gtmetrix.com/',
                'producer' => [
                    'name' => 'Carbon60 Operating Co. Ltd.',
                    'url' => 'https://www.carbon60.com/',
                ],
            ],
            [
                'regex' => 'Nutch',
                'name' => 'Nutch-based Bot',
                'category' => 'Crawler',
                'url' => 'https://nutch.apache.org',
                'producer' => [
                    'name' => 'The Apache Software Foundation',
                    'url' => 'https://www.apache.org/foundation/',
                ],
            ],
            [
                'regex' => 'Seobility',
                'name' => 'Seobility',
                'category' => 'Crawler',
                'url' => 'https://www.seobility.net/en/faq/?category=crawling#!aboutourbot',
            ],
            [
                'regex' => 'Vercelbot',
                'name' => 'Vercel Bot',
                'category' => 'Service bot',
                'url' => 'https://vercel.com',
            ],
            [
                'regex' => 'Grammarly',
                'name' => 'Grammarly',
                'category' => 'Service bot',
                'url' => 'https://www.grammarly.com',
            ],
            [
                'regex' => 'Robozilla',
                'name' => 'Robozilla',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'Domains Project',
                'name' => 'Domains Project',
                'category' => 'Crawler',
                'url' => 'https://domainsproject.org',
            ],
            [
                'regex' => 'PetalBot',
                'name' => 'Petal Bot',
                'category' => 'Crawler',
                'url' => 'https://aspiegel.com/petalbot',
            ],
            [
                'regex' => 'SerendeputyBot',
                'name' => 'Serendeputy Bot',
                'category' => 'Crawler',
                'url' => 'https://serendeputy.com/about/serendeputy-bot',
            ],
            [
                'regex' => 'ias-(?:va|sg).*admantx.*service-fetcher|admantx.com.*service-fetcher',
                'name' => 'ADmantX Service Fetcher',
                'category' => 'Service bot',
                'url' => 'https://www.admantx.com/service-fetcher.html',
            ],
            [
                'regex' => 'SemanticScholarBot',
                'name' => 'Semantic Scholar Bot',
                'category' => 'Crawler',
                'url' => 'https://www.semanticscholar.org/crawler',
            ],
            [
                'regex' => 'VelenPublicWebCrawler',
                'name' => 'Velen Public Web Crawler',
                'category' => 'Crawler',
                'url' => 'https://hunter.io/robot',
            ],
            [
                'regex' => 'Barkrowler',
                'name' => 'Barkrowler',
                'category' => 'Crawler',
                'url' => 'http://www.exensa.com/crawl',
            ],
            [
                'regex' => 'BDCbot',
                'name' => 'BDCbot',
                'category' => 'Crawler',
                'url' => 'https://bigweb.bigdatacorp.com.br/pages/faq.aspx',
                'producer' => [
                    'name' => 'BIG Data Solucoes Em Tecnologia de Informatica LTDA',
                    'url' => 'https://bigdatacorp.com.br/',
                ],
            ],
            [
                'regex' => 'adbeat',
                'name' => 'Adbeat',
                'category' => 'Crawler',
                'url' => 'https://www.adbeat.com/operation_policy',
                'producer' => [
                    'name' => 'PPC Labs LLC',
                    'url' => 'https://www.adbeat.com/',
                ],
            ],
            [
                'regex' => 'BW\\/(?:(\\d+[\\.\\d]+))',
                'name' => 'BuiltWith',
                'category' => 'Crawler',
                'url' => 'https://builtwith.com/biup',
                'producer' => [
                    'name' => 'BuiltWith Pty Ltd',
                    'url' => 'https://builtwith.com/',
                ],
            ],
            [
                'regex' => 'https:\\/\\/whatis.contentkingapp.com',
                'name' => 'ContentKing',
                'category' => 'Site Monitor',
                'url' => 'https://whatis.contentkingapp.com/',
                'producer' => [
                    'name' => 'ContentKing BV',
                    'url' => 'https://www.contentkingapp.com/',
                ],
            ],
            [
                'regex' => 'MicroAdBot',
                'name' => 'MicroAdBot',
                'category' => 'Crawler',
                'url' => 'https://www.microad.co.jp/',
                'producer' => [
                    'name' => 'MicroAd, Inc.',
                    'url' => 'https://www.microad.co.jp/',
                ],
            ],
            [
                'regex' => 'PingAdmin.Ru',
                'name' => 'PingAdmin.Ru',
                'category' => 'Site Monitor',
                'url' => 'https://ping-admin.ru/',
            ],
            [
                'regex' => 'notifyninja.+monitoring',
                'name' => 'Notify Ninja',
                'category' => 'Site Monitor',
                'url' => 'http://notifyninja.com',
            ],
            [
                'regex' => 'WebDataStats',
                'name' => 'WebDataStats',
                'category' => 'Crawler',
                'url' => 'https://webdatastats.com/policy.html',
                'producer' => [
                    'name' => 'WebTehRazrabotka LLC',
                    'url' => 'https://webdatastats.com/',
                ],
            ],
            [
                'regex' => 'parse.ly scraper',
                'name' => 'parse.ly',
                'category' => 'Crawler',
                'url' => 'https://www.parse.ly/help/integration/crawler',
                'producer' => [
                    'name' => 'Parsely, Inc.',
                    'url' => 'https://www.parse.ly/',
                ],
            ],
            [
                'regex' => 'Nimbostratus-Bot',
                'name' => 'Nimbostratus Bot',
                'category' => 'Site Monitor',
                'url' => 'http://cloudsystemnetworks.com',
            ],
            [
                'regex' => 'HeartRails_Capture\\/\\d',
                'name' => 'Heart Rails Capture',
                'category' => 'Service Agent',
                'url' => 'http://capture.heartrails.com',
            ],
            [
                'regex' => 'Project-Resonance',
                'name' => 'Project Resonance',
                'category' => 'Crawler',
                'url' => 'http://project-resonance.com',
            ],
            [
                'regex' => 'DataXu\\/\\d',
                'name' => 'DataXu',
                'category' => 'Service Agent',
                'url' => 'https://advertising.roku.com/dataxu',
                'producer' => [
                    'name' => 'Roku, Inc.',
                    'url' => 'https://roku.com',
                ],
            ],
            [
                'regex' => 'Cocolyzebot',
                'name' => 'Cocolyzebot',
                'category' => 'Crawler',
                'url' => 'https://cocolyze.com/en/cocolyzebot',
                'producer' => [
                    'name' => 'VSI INNOVATION SAS',
                    'url' => 'https://vsi-innovation.com/',
                ],
            ],
            [
                'regex' => 'veryhip',
                'name' => 'VeryHip',
                'category' => 'Crawler',
                'url' => 'https://veryhip.com/',
                'producer' => [
                    'name' => 'VeryHip',
                    'url' => 'https://veryhip.com/',
                ],
            ],
            [
                'regex' => 'LinkpadBot',
                'name' => 'LinkpadBot',
                'category' => 'Crawler',
                'url' => 'https://www.linkpad.org/',
                'producer' => [
                    'name' => 'Solomono LLC',
                    'url' => 'https://www.linkpad.org/',
                ],
            ],
            [
                'regex' => 'MuscatFerret',
                'name' => 'MuscatFerret',
                'category' => 'Crawler',
                'url' => 'http://www.webtop.com/',
            ],
            [
                'regex' => 'PageThing.com',
                'name' => 'PageThing',
                'category' => 'Crawler',
                'url' => 'https://www.pagething.com/',
                'producer' => [
                    'name' => 'SPECIALNOISE LTD',
                    'url' => 'https://www.specialnoise.com/',
                ],
            ],
            [
                'regex' => 'ArchiveBox',
                'name' => 'ArchiveBox',
                'url' => 'https://archivebox.io/',
                'category' => 'Crawler',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Choosito',
                'name' => 'Choosito',
                'url' => 'https://www.choosito.com/',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'Choosito! Inc.',
                    'url' => 'https://www.choosito.com/',
                ],
            ],
            [
                'regex' => 'datagnionbot',
                'name' => 'datagnionbot',
                'url' => 'https://www.datagnion.com/bot.html',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'DATAGNION GMBH',
                    'url' => 'https://www.datagnion.com/',
                ],
            ],
            [
                'regex' => 'WhatCMS',
                'name' => 'WhatCMS',
                'url' => 'https://whatcms.org/',
                'category' => 'Crawler',
                'producer' => [
                    'name' => 'Nineteen Ten LLC',
                    'url' => 'https://whatcms.org/',
                ],
            ],
            [
                'regex' => 'httpx',
                'name' => 'httpx',
                'url' => 'https://github.com/projectdiscovery/httpx',
                'category' => 'Crawler',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'scaninfo@(?:expanseinc|paloaltonetworks).com',
                'name' => 'Expanse',
                'category' => 'Security Checker',
                'url' => 'https://expanse.co/',
                'producer' => [
                    'name' => 'Expanse Inc.',
                    'url' => 'https://expanse.co/',
                ],
            ],
            [
                'regex' => 'HuaweiWebCatBot',
                'name' => 'HuaweiWebCatBot',
                'category' => 'Crawler',
                'url' => 'https://isecurity.huawei.com',
                'producer' => [
                    'name' => 'Huawei Technologies Co., Ltd.',
                    'url' => 'https://huawei.com',
                ],
            ],
            [
                'regex' => 'Hatena-Favicon',
                'name' => 'Hatena Favicon',
                'category' => 'Crawler',
                'url' => 'https://www.hatena.ne.jp/faq/',
                'producer' => [
                    'name' => 'Hatena Co., Ltd.',
                    'url' => 'https://www.hatena.ne.jp',
                ],
            ],
            [
                'regex' => 'Hatena-?Bookmark',
                'name' => 'Hatena Bookmark',
                'category' => 'Crawler',
                'url' => 'https://www.hatena.ne.jp/faq/',
                'producer' => [
                    'name' => 'Hatena Co., Ltd.',
                    'url' => 'https://www.hatena.ne.jp',
                ],
            ],
            [
                'regex' => 'RyowlEngine\\/(\\d+)',
                'name' => 'Ryowl',
                'category' => 'Crawler',
                'url' => 'https://ryowl.org',
            ],
            [
                'regex' => 'OdklBot\\/(\\d+)',
                'name' => 'Odnoklassniki Bot',
                'category' => 'Crawler',
                'url' => 'https://odnoklassniki.ru',
            ],
            [
                'regex' => 'Mediatoolkitbot',
                'name' => 'Mediatoolkit Bot',
                'category' => 'Crawler',
                'url' => 'https://mediatoolkit.com',
            ],
            [
                'regex' => 'ZoominfoBot',
                'name' => 'ZoominfoBot',
                'category' => 'Crawler',
                'url' => 'https://www.zoominfo.com',
            ],
            [
                'regex' => 'WeViKaBot\\/([\\d+\\.])',
                'name' => 'WeViKaBot',
                'category' => 'Crawler',
                'url' => 'http://www.wevika.de',
            ],
            [
                'regex' => 'SEOkicks',
                'name' => 'SEOkicks',
                'category' => 'Crawler',
                'url' => 'https://www.seokicks.de/robot.html',
            ],
            [
                'regex' => 'Plukkie\\/([\\d+\\.])',
                'name' => 'Plukkie',
                'category' => 'Crawler',
                'url' => 'http://www.botje.com/plukkie.htm',
            ],
            [
                'regex' => 'proximic;',
                'name' => 'Comscore',
                'category' => 'Crawler',
                'url' => 'https://www.comscore.com/Web-Crawler',
            ],
            [
                'regex' => 'SurdotlyBot\\/([\\d+\\.])',
                'name' => 'SurdotlyBot',
                'category' => 'Crawler',
                'url' => 'http://sur.ly/bot.html',
            ],
            [
                'regex' => 'Gowikibot\\/([\\d+\\.])',
                'name' => 'Gowikibot',
                'category' => 'Crawler',
                'url' => 'http:/www.gowikibot.com',
            ],
            [
                'regex' => 'SabsimBot\\/([\\d+\\.])',
                'name' => 'SabsimBot',
                'category' => 'Crawler',
                'url' => 'https://sabsim.com',
            ],
            [
                'regex' => 'LumtelBot\\/([\\d+\\.])',
                'name' => 'LumtelBot',
                'category' => 'Crawler',
                'url' => 'https://umtel.com',
            ],
            [
                'regex' => 'PiplBot',
                'name' => 'PiplBot',
                'category' => 'Crawler',
                'url' => 'http://www.pipl.com/bot',
            ],
            [
                'regex' => 'woobot\\/([\\d+\\.])',
                'name' => 'WooRank',
                'category' => 'Crawler',
                'url' => 'https://www.woorank.com/bot',
            ],
            [
                'regex' => 'Cookiebot\\/([\\d+\\.])',
                'name' => 'Cookiebot',
                'category' => 'Crawler',
                'url' => 'https://support.cookiebot.com/hc/en-us/articles/360014264140-Scanner-User-Agent',
                'producer' => [
                    'name' => 'Cybot A/S',
                    'url' => 'https://www.cybot.com/',
                ],
            ],
            [
                'regex' => 'NetSystemsResearch',
                'name' => 'NetSystemsResearch',
                'category' => 'Security Checker',
                'url' => 'https://www.netsystemsresearch.com/',
                'producer' => [
                    'name' => 'NET SYSTEMS RESEARCH LLC',
                    'url' => 'https://www.netsystemsresearch.com/',
                ],
            ],
            [
                'regex' => 'CensysInspect\\/([\\d+\\.])',
                'name' => 'CensysInspect',
                'category' => 'Security Checker',
                'url' => 'https://about.censys.io/',
                'producer' => [
                    'name' => 'Censys, Inc.',
                    'url' => 'https://censys.io/',
                ],
            ],
            [
                'regex' => 'gdnplus.com',
                'name' => 'GDNP',
                'category' => 'Crawler',
                'url' => 'https://gdnplus.com/',
                'producer' => [
                    'name' => 'Global Digital Network Plus, LLC',
                    'url' => 'https://gdnplus.com/',
                ],
            ],
            [
                'regex' => 'WellKnownBot\\/([\\d+\\.])',
                'name' => 'WellKnownBot',
                'category' => 'Crawler',
                'url' => 'https://well-known.dev',
            ],
            [
                'regex' => 'Adsbot\\/([\\d+\\.])',
                'name' => 'Adsbot',
                'category' => 'Crawler',
                'url' => 'https://seostar.co/robot/',
            ],
            [
                'regex' => 'MTRobot\\/([\\d+\\.])',
                'name' => 'MTRobot',
                'category' => 'Crawler',
                'url' => 'https://metrics-tools.de/robot.html',
                'producer' => [
                    'name' => 'Metrics Tools',
                    'url' => 'https://metrics-tools.de/',
                ],
            ],
            [
                'regex' => 'serpstatbot\\/([\\d+\\.])',
                'name' => 'serpstatbot',
                'category' => 'Crawler',
                'url' => 'http://serpstatbot.com/',
                'producer' => [
                    'name' => 'Netpeak Ltd',
                    'url' => 'https://netpeak.net/',
                ],
            ],
            [
                'regex' => 'colly',
                'name' => 'colly',
                'category' => 'Crawler',
                'url' => 'https://github.com/gocolly/colly/',
            ],
            [
                'regex' => 'l9tcpid\\/v([\\d+\\.])',
                'name' => 'l9tcpid',
                'category' => 'Security Checker',
                'url' => 'https://github.com/LeakIX/l9tcpid',
            ],
            [
                'regex' => 'l9explore\\/([\\d+\\.])',
                'name' => 'l9explore',
                'category' => 'Security Checker',
                'url' => 'https://github.com/LeakIX/l9explore',
            ],
            [
                'regex' => 'l9scan\\/|^Lkx-(.*)\\/([\\d+.]+)',
                'name' => 'LeakIX',
                'category' => 'Security Checker',
                'url' => 'https://leakix.net/',
                'producer' => [
                    'name' => 'BaDaaS SRL',
                    'url' => 'https://leakix.net/',
                ],
            ],
            [
                'regex' => 'MegaIndex.ru\\/([\\d+\\.])',
                'name' => 'MegaIndex',
                'category' => 'Crawler',
                'url' => 'https://megaindex.com/crawler',
            ],
            [
                'regex' => 'Seekport',
                'name' => 'Seekport',
                'category' => 'Crawler',
                'url' => 'http://www.seekport.com/',
                'producer' => [
                    'name' => 'SISTRIX GmbH',
                    'url' => 'https://www.sistrix.de/',
                ],
            ],
            [
                'regex' => 'seolyt\\/([\\d+\\.])',
                'name' => 'seolyt',
                'category' => 'Crawler',
                'url' => 'https://seolyt.com/',
            ],
            [
                'regex' => 'YaK\\/([\\d+\\.])',
                'name' => 'YaK',
                'category' => 'Crawler',
                'url' => 'https://www.linkfluence.com/',
                'producer' => [
                    'name' => 'Linkfluence SAS',
                    'url' => 'https://www.linkfluence.com/',
                ],
            ],
            [
                'regex' => 'KomodiaBot\\/([\\d+\\.])',
                'name' => 'KomodiaBot',
                'category' => 'Crawler',
                'url' => 'http://www.komodia.com/newwiki/index.php/URL_server_crawler',
                'producer' => [
                    'name' => 'Komodia Inc.',
                    'url' => 'https://www.komodia.com/',
                ],
            ],
            [
                'regex' => 'Neevabot\\/([\\d+\\.])',
                'name' => 'Neevabot',
                'category' => 'Search bot',
                'url' => 'https://neeva.com/neevabot',
                'producer' => [
                    'name' => 'Neeva Inc.',
                    'url' => 'https://neeva.com/',
                ],
            ],
            [
                'regex' => 'LinkPreview\\/([\\d+\\.])',
                'name' => 'LinkPreview',
                'category' => 'Service Agent',
                'url' => 'https://www.linkpreview.net/',
            ],
            [
                'regex' => 'JungleKeyThumbnail\\/([\\d+\\.])',
                'name' => 'JungleKeyThumbnail',
                'category' => 'Crawler',
                'url' => 'https://junglekey.com/',
            ],
            [
                'regex' => 'rocketmonitor(?: |bot\\/)([\\d+\\.])',
                'name' => 'RocketMonitorBot',
                'category' => 'Site Monitor',
                'url' => 'https://www.radiomast.io/docs/stream-monitoring/technical_details.html',
                'producer' => [
                    'name' => 'Radio Mast, Inc.',
                    'url' => 'https://www.radiomast.io/',
                ],
            ],
            [
                'regex' => 'SitemapParser-VIPnytt\\/([\\d+\\.])',
                'name' => 'SitemapParser-VIPnytt',
                'category' => 'Crawler',
                'url' => 'https://github.com/VIPnytt/SitemapParser/',
            ],
            [
                'regex' => '^Turnitin',
                'name' => 'Turnitin',
                'category' => 'Crawler',
                'url' => 'https://turnitin.com/robot/crawlerinfo.html',
            ],
            [
                'regex' => 'DMBrowser\\/\\d+|DMBrowser-[UB]V',
                'name' => 'Dotcom Monitor',
                'category' => 'Site Monitor',
                'url' => 'https://www.dotcom-monitor.com',
            ],
            [
                'regex' => 'ThinkChaos\\/',
                'name' => 'ThinkChaos',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'DataForSeoBot',
                'name' => 'DataForSeoBot',
                'category' => 'Crawler',
                'url' => 'https://dataforseo.com/dataforseo-bot',
            ],
            [
                'regex' => 'Discordbot\\/([\\d+.]+)',
                'name' => 'Discord Bot',
                'category' => 'Service Agent',
                'url' => 'https://discordapp.com',
            ],
            [
                'regex' => 'Linespider\\/([\\d+.]+)',
                'name' => 'Linespider',
                'category' => 'Crawler',
                'url' => 'https://lin.ee/4dwXkTH',
            ],
            [
                'regex' => 'Cincraw\\/([\\d+.]+)',
                'name' => 'Cincraw',
                'category' => 'Crawler',
                'url' => 'http://cincrawdata.net/bot/',
            ],
            [
                'regex' => 'CISPA Web Analyzer',
                'name' => 'CISPA Web Analyzer',
                'category' => 'Crawler',
                'url' => 'https://notify.cispa.de/',
                'producer' => [
                    'name' => 'CISPA - Helmholtz-Zentrum für Informationssicherheit gGmbH',
                    'url' => 'https://cispa.de/en',
                ],
            ],
            [
                'regex' => 'IonCrawl',
                'name' => 'IONOS Crawler',
                'category' => 'Crawler',
                'url' => 'https://www.ionos.de/terms-gtc/faq-crawler-en/',
                'producer' => [
                    'name' => 'IONOS SE',
                    'url' => 'https://www.ionos.de/',
                ],
            ],
            [
                'regex' => 'Crawldad',
                'name' => 'Crawldad',
                'category' => 'Crawler',
                'url' => 'https://gist.github.com/jayhardee9/2f2a2c4dba26564ee040ae32e0dd0972',
            ],
            [
                'regex' => 'https:\\/\\/securitytxt-scan.cs.hm.edu\\/',
                'name' => 'security.txt scanserver',
                'category' => 'Security Checker',
                'url' => 'https://securitytxt-scan.cs.hm.edu/',
                'producer' => [
                    'name' => 'Hochschule für angewandte Wissenschaften München',
                    'url' => 'https://www.hm.edu/',
                ],
            ],
            [
                'regex' => 'TigerBot\\/([\\d+.]+)',
                'name' => 'TigerBot',
                'category' => 'Crawler',
                'url' => 'https://tiger.ch/',
            ],
            [
                'regex' => 'TestCrawler\\/([\\d+.]+)',
                'name' => 'TestCrawler',
                'category' => 'Crawler',
                'url' => 'https://www.comcepta.com/',
            ],
            [
                'regex' => 'CrowdTanglebot\\/([\\d+.]+)',
                'name' => 'CrowdTangle',
                'category' => 'Crawler',
                'url' => 'https://help.crowdtangle.com/en/articles/3009319-crowdtangle-bot',
                'producer' => [
                    'name' => 'CrowdTangle, Inc.',
                    'url' => 'https://www.crowdtangle.com/',
                ],
            ],
            [
                'regex' => 'Sellers.Guide Crawler by Primis',
                'name' => 'Sellers.Guide',
                'category' => 'Crawler',
                'url' => 'https://sellers.guide/',
                'producer' => [
                    'name' => 'McCann Disciplines, Ltd.',
                    'url' => 'https://www.primis.tech/',
                ],
            ],
            [
                'regex' => 'OnalyticaBot',
                'name' => 'Onalytica',
                'category' => 'Crawler',
                'url' => 'https://www.airslate.com/bot/explore/onalytica-bot',
                'producer' => [
                    'name' => 'airSlate, Inc.',
                    'url' => 'https://www.airslate.com/',
                ],
            ],
            [
                'regex' => 'deepnoc',
                'name' => 'deepnoc',
                'category' => 'Crawler',
                'url' => 'https://deepnoc.com/bot',
                'producer' => [
                    'name' => 'deepnoc, GmbH',
                    'url' => 'https://deepnoc.com/',
                ],
            ],
            [
                'regex' => 'Newslitbot\\/([\\d+.]+)',
                'name' => 'Newslitbot',
                'category' => 'Crawler',
                'url' => 'https://www.newslit.co/',
                'producer' => [
                    'name' => 'Newslit, LLC.',
                    'url' => 'https://www.newslit.co/',
                ],
            ],
            [
                'regex' => 'um-LN\\/([\\d+.]+)',
                'name' => 'uMBot',
                'category' => 'Crawler',
                'url' => 'https://www.ubermetrics-technologies.com/',
                'producer' => [
                    'name' => 'Ubermetrics Technologies GmbH',
                    'url' => 'https://www.ubermetrics-technologies.com/',
                ],
            ],
            [
                'regex' => 'Abonti\\/([\\d+.]+)',
                'name' => 'Abonti',
                'category' => 'Crawler',
                'url' => 'http://abonti.com/',
            ],
            [
                'regex' => 'collection@infegy.com',
                'name' => 'Infegy',
                'category' => 'Crawler',
                'url' => 'https://infegy.com/',
                'producer' => [
                    'name' => 'Infegy, Inc.',
                    'url' => 'https://infegy.com/',
                ],
            ],
            [
                'regex' => 'HTTP Banner Detection \\(https:\\/\\/security.ipip.net\\)',
                'name' => 'IPIP',
                'category' => 'Security Checker',
                'url' => 'https://security.ipip.net/',
                'producer' => [
                    'name' => 'Beijing Tiantexin Tech. Co., Ltd.',
                    'url' => 'https://en.ipip.net/',
                ],
            ],
            [
                'regex' => 'ev-crawler\\/([\\d+.]+)',
                'name' => 'Headline',
                'category' => 'Crawler',
                'url' => 'https://headline.com/legal/crawler',
                'producer' => [
                    'name' => 'e.ventures Managementgesellschaft mbH',
                    'url' => 'https://headline.com/',
                ],
            ],
            [
                'regex' => 'webprosbot\\/([\\d+.]+)',
                'name' => 'WebPros',
                'category' => 'Crawler',
                'url' => 'https://webpros.com/',
                'producer' => [
                    'name' => 'WebPros Holdco B.V.',
                    'url' => 'https://webpros.com/',
                ],
            ],
            [
                'regex' => 'ELB-HealthChecker',
                'name' => 'Amazon ELB',
                'category' => 'Site Monitor',
                'url' => 'https://aws.amazon.com/elasticloadbalancing/',
                'producer' => [
                    'name' => 'Amazon.com, Inc.',
                    'url' => 'https://www.amazon.com/',
                ],
            ],
            [
                'regex' => 'Wheregoes.com Redirect Checker\\/([\\d+.]+)',
                'name' => 'WhereGoes',
                'category' => 'Crawler',
                'url' => 'https://wheregoes.com/',
            ],
            [
                'regex' => 'project_patchwatch',
                'name' => 'Project Patchwatch',
                'category' => 'Crawler',
                'url' => 'http://66.240.192.82/',
            ],
            [
                'regex' => 'InternetMeasurement\\/([\\d+.]+)',
                'name' => 'InternetMeasurement',
                'category' => 'Crawler',
                'url' => 'https://internet-measurement.com/',
            ],
            [
                'regex' => 'DomainAppender \\/([\\d+.]+)',
                'name' => 'DomainAppender',
                'category' => 'Crawler',
                'url' => 'https://www.profound.net/product/domain_append/',
                'producer' => [
                    'name' => 'Profound Networks, LLC',
                    'url' => 'https://www.profound.net/',
                ],
            ],
            [
                'regex' => 'FreeWebMonitoring SiteChecker\\/([\\d+.]+)',
                'name' => 'FreeWebMonitoring',
                'category' => 'Site Monitor',
                'url' => 'https://www.freewebmonitoring.com/bot.html',
                'producer' => [
                    'name' => 'GreenWave Online, Inc.',
                    'url' => 'http://www.greenwaveonline.com/',
                ],
            ],
            [
                'regex' => 'Page Modified Pinger',
                'name' => 'Page Modified Pinger',
                'category' => 'Site Monitor',
                'url' => 'https://www.pagemodified.com/',
                'producer' => [
                    'name' => 'Valley Hosting, LLC',
                    'url' => 'https://www.pagemodified.com/',
                ],
            ],
            [
                'regex' => 'adstxtlab.com',
                'name' => 'adstxtlab.com',
                'category' => 'Crawler',
                'url' => 'https://adstxtlab.com/validator.php',
                'producer' => [
                    'name' => 'Jaohawi AB',
                    'url' => 'https://adstxtlab.com/',
                ],
            ],
            [
                'regex' => 'Iframely\\/([\\d+.]+)',
                'name' => 'Iframely',
                'category' => 'Crawler',
                'url' => 'https://iframely.com/',
                'producer' => [
                    'name' => 'Itteco Software, Corp.',
                    'url' => 'https://iframely.com/',
                ],
            ],
            [
                'regex' => 'DomainStatsBot\\/([\\d+.]+)',
                'name' => 'DomainStatsBot',
                'category' => 'Crawler',
                'url' => 'https://domainstats.com/pages/our-bot',
                'producer' => [
                    'name' => 'Domainstats Ltd',
                    'url' => 'https://domainstats.com/',
                ],
            ],
            [
                'regex' => 'aiHitBot\\/([\\d+.]+)',
                'name' => 'aiHitBot',
                'category' => 'Crawler',
                'url' => 'https://www.aihitdata.com/about',
            ],
            [
                'regex' => 'DomainCrawler\\/',
                'name' => 'DomainCrawler',
                'category' => 'Crawler',
                'url' => 'https://domaincrawler.com/about-us/',
            ],
            [
                'regex' => 'DNSResearchBot',
                'name' => 'DNSResearchBot',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'GitCrawlerBot',
                'name' => 'GitCrawlerBot',
                'category' => 'Crawler',
            ],
            [
                'regex' => 'AdAuth\\/([\\d+.]+)',
                'name' => 'AdAuth',
                'category' => 'Crawler',
                'url' => 'https://www.adauth.com',
            ],
            [
                'regex' => 'faveeo.com',
                'name' => 'Faveeo',
                'category' => 'Crawler',
                'url' => 'http://www.faveeo.com',
            ],
            [
                'regex' => 'kozmonavt\\.',
                'name' => 'Kozmonavt',
                'category' => 'Crawler',
                'url' => 'https://kozmonavt.ml',
            ],
            [
                'regex' => 'CriteoBot\\/',
                'name' => 'CriteoBot',
                'category' => 'Crawler',
                'url' => 'https://www.criteo.com/criteo-crawler/',
            ],
            [
                'regex' => 'PayPal IPN',
                'name' => 'PayPal IPN',
                'category' => 'Service Agent',
                'url' => 'https://developer.paypal.com/api/nvp-soap/ipn/IPNIntro/',
                'producer' => [
                    'name' => 'PayPal, Inc.',
                    'url' => 'https://www.paypal.com/',
                ],
            ],
            [
                'regex' => 'MaCoCu',
                'name' => 'MaCoCu',
                'category' => 'Crawler',
                'url' => 'https://www.clarin.si/info/macocu-massive-collection-and-curation-of-monolingual-and-bilingual-data/',
                'producer' => [
                    'name' => 'Jožef Stefan Institute',
                    'url' => 'https://www.ijs.si/ijsw/JSI',
                ],
            ],
            [
                'regex' => 'dnt-policy@eff.org',
                'name' => 'EFF Do Not Track Verifier',
                'category' => 'Crawler',
                'url' => 'https://www.eff.org/issues/do-not-track',
                'producer' => [
                    'name' => 'Electronic Frontier Foundation',
                    'url' => 'https://www.eff.org/',
                ],
            ],
            [
                'regex' => 'InfoTigerBot',
                'name' => 'InfoTigerBot',
                'category' => 'Crawler',
                'url' => 'https://infotiger.com/bot',
                'producer' => [
                    'name' => 'Infotiger UG',
                    'url' => 'https://infotiger.com/',
                ],
            ],
            [
                'regex' => '(?:Birdcrawlerbot|CrawlaDeBot)',
                'name' => 'Birdcrawlerbot',
                'category' => 'Crawler',
                'url' => 'https://crawla.de/de/index.php',
                'producer' => [
                    'name' => 'Swoppen Systems GmbH',
                    'url' => 'https://www.swoppen.com/de',
                ],
            ],
            [
                'regex' => 'ScamadviserExternalHit\\/([\\d+.]+)',
                'name' => 'Scamadviser External Hit',
                'category' => 'Crawler',
                'url' => 'https://www.scamadviser.com/',
                'producer' => [
                    'name' => 'Ecommerce Operations B.V.',
                    'url' => 'https://www.scamadviser.com/',
                ],
            ],
            [
                'regex' => 'ZaldamoSearchBot',
                'name' => 'Zaldamo',
                'category' => 'Crawler',
                'url' => 'https://www.zaldamo.com/search.html',
                'producer' => [
                    'name' => 'Project Orlando, LLC.',
                    'url' => 'https://www.projectorlando.com/',
                ],
            ],
            [
                'regex' => 'AFB\\/([\\d+.]+)',
                'name' => 'Allloadin Favicon Bot',
                'category' => 'Crawler',
                'url' => 'https://allloadin.com/',
            ],
            [
                'regex' => 'SeolytBot\\/([\\d+.]+)',
                'name' => 'Seolyt Bot',
                'category' => 'Crawler',
                'url' => 'https://seolyt.com',
            ],
            [
                'regex' => 'LinkWalker\\/([\\d+.]+)',
                'name' => 'LinkWalker',
                'category' => 'Crawler',
                'url' => 'https://www.phishlabs.com/',
                'producer' => [
                    'name' => 'PhishLabs, Inc.',
                    'url' => 'https://www.phishlabs.com/',
                ],
            ],
            [
                'regex' => 'RenovateBot\\/([\\d+.]+)',
                'name' => 'RenovateBot',
                'category' => 'Security Checker',
                'url' => 'https://github.com/renovatebot/renovate',
                'producer' => [
                    'name' => 'White Source Ltd.',
                    'url' => 'https://www.mend.io/free-developer-tools/renovate/',
                ],
            ],
            [
                'regex' => 'INETDEX-BOT\\/([\\d+.]+)',
                'name' => 'Inetdex Bot',
                'category' => 'Crawler',
                'url' => 'https://www.inetdex.com/',
            ],
            [
                'regex' => 'NETZZAPPEN',
                'name' => 'NETZZAPPEN',
                'category' => 'Crawler',
                'url' => 'https://www.netzzappen.com/',
                'producer' => [
                    'name' => 'Marc Huemer',
                    'url' => 'https://www.netzzappen.com/',
                ],
            ],
            [
                'regex' => 'SerpReputationManagementAgent\\/([\\d+.]+)',
                'name' => 'SEMrush Reputation Management',
                'category' => 'Service Agent',
                'url' => 'https://www.semrush.com/bot/',
                'producer' => [
                    'name' => 'SEMrush',
                    'url' => 'https://www.semrush.com/',
                ],
            ],
            [
                'regex' => 'panscient.com',
                'name' => 'Panscient',
                'category' => 'Crawler',
                'url' => 'https://www.panscient.com/faq.htm',
                'producer' => [
                    'name' => 'Panscient, Inc.',
                    'url' => 'https://www.panscient.com/',
                ],
            ],
            [
                'regex' => 'research@pdrlabs.net',
                'name' => 'PDR Labs',
                'category' => 'Security Checker',
                'url' => 'https://web.archive.org/web/20220420054123/http://www.pdrlabs.net/',
                'producer' => [
                    'name' => 'PDR Labs',
                    'url' => 'https://web.archive.org/web/20220420054123/http://www.pdrlabs.net/',
                ],
            ],
            [
                'regex' => 'Nicecrawler\\/([\\d+.]+)',
                'name' => 'NiceCrawler',
                'category' => 'Crawler',
                'url' => 'https://www.nicecrawler.com/',
                'producer' => [
                    'name' => 'Intelium Corp.',
                    'url' => 'https://www.intelium.com/',
                ],
            ],
            [
                'regex' => 't3versionsBot\\/([\\d+.]+)',
                'name' => 't3versions',
                'category' => 'Crawler',
                'url' => 'https://www.t3versions.com/bot',
                'producer' => [
                    'name' => 'Torben Hansen',
                    'url' => 'https://www.t3versions.com/',
                ],
            ],
            [
                'regex' => 'Crawlson\\/([\\d+.]+)',
                'name' => 'Crawlson',
                'category' => 'Crawler',
                'url' => 'https://www.crawlson.com/about',
                'producer' => [
                    'name' => 'Crawlson',
                    'url' => 'https://www.crawlson.com/',
                ],
            ],
            [
                'regex' => 'tchelebi\\/([\\d+.]+)',
                'name' => 'tchelebi',
                'category' => 'Crawler',
                'url' => 'https://tchelebi.io/',
                'producer' => [
                    'name' => 'NormShield, Inc.',
                    'url' => 'https://blackkite.com/',
                ],
            ],
            [
                'regex' => 'JobboerseBot',
                'name' => 'JobboerseBot',
                'category' => 'Crawler',
                'url' => 'https://www.xing.com/jobs',
                'producer' => [
                    'name' => 'New Work SE',
                    'url' => 'https://www.xing.com/',
                ],
            ],
            [
                'regex' => 'RepoLookoutBot\\/([\\d+.]+)',
                'name' => 'Repo Lookout',
                'category' => 'Security Checker',
                'url' => 'https://www.repo-lookout.org/',
                'producer' => [
                    'name' => 'Crissy Field GmbH',
                    'url' => 'https://www.crissyfield.de/',
                ],
            ],
            [
                'regex' => 'PATHspider',
                'name' => 'PATHspider',
                'category' => 'Security Checker',
                'url' => 'https://pathspider.net/',
                'producer' => [
                    'name' => 'MAMI Project',
                    'url' => 'https://mami-project.eu/',
                ],
            ],
            [
                'regex' => 'everyfeed-spider\\/([\\d+.]+)',
                'name' => 'Everyfeed',
                'url' => 'https://web.archive.org/web/20050930235914/http://www.everyfeed.com/',
                'category' => 'Feed Fetcher',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Exchange check',
                'name' => 'Exchange check',
                'category' => 'Security Checker',
                'url' => 'https://github.com/GossiTheDog/scanning',
                'producer' => [
                    'name' => 'Kevin Beaumont',
                    'url' => 'https://doublepulsar.com/',
                ],
            ],
            [
                'regex' => 'Sublinq',
                'name' => 'Sublinq',
                'category' => 'Crawler',
                'url' => 'https://web.archive.org/web/20220626191617/https://sublinq.com/',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'Gregarius\\/([\\d+.]+)',
                'name' => 'Gregarius',
                'category' => 'Feed Fetcher',
                'url' => 'https://web.archive.org/web/20100614011837/http://devlog.gregarius.net/docs/ua/',
                'producer' => [
                    'name' => '',
                    'url' => '',
                ],
            ],
            [
                'regex' => 'COMODO DCV',
                'name' => 'COMODO DCV',
                'category' => 'Service Agent',
                'url' => 'https://www.comodo.com/',
                'producer' => [
                    'name' => 'Comodo Security Solutions, Inc.',
                    'url' => 'https://www.comodo.com/',
                ],
            ],
            [
                'regex' => 'Sectigo DCV',
                'name' => 'Sectigo DCV',
                'category' => 'Service Agent',
                'url' => 'https://sectigo.com/',
                'producer' => [
                    'name' => 'Sectigo Limited',
                    'url' => 'https://sectigo.com/',
                ],
            ],
            [
                'regex' => 'KlarnaBot-(?:DownloadProductImage|EnrichProducts|PriceWatcher)\\/([\\d+.]+)',
                'name' => 'KlarnaBot',
                'category' => 'Crawler',
                'url' => 'https://docs.klarna.com/klarna-bot/',
                'producer' => [
                    'name' => 'Klarna Bank AB',
                    'url' => 'https://www.klarna.com/',
                ],
            ],
            [
                'regex' => 'Taboolabot\\/([\\d+.]+)',
                'name' => 'Taboolabot',
                'category' => 'Crawler',
                'url' => 'https://help.taboola.com/hc/en-us/articles/115002347594-The-Taboola-Crawler',
                'producer' => [
                    'name' => 'Taboola, Inc.',
                    'url' => 'https://www.taboola.com/',
                ],
            ],
            [
                'regex' => 'Asana\\/([\\d+.]+)',
                'name' => 'Asana',
                'category' => 'Crawler',
                'url' => 'https://asana.com/',
                'producer' => [
                    'name' => 'Asana, Inc.',
                    'url' => 'https://asana.com/',
                ],
            ],
            [
                'regex' => 'Chrome Privacy Preserving Prefetch Proxy',
                'name' => 'Chrome Privacy Preserving Prefetch Proxy',
                'category' => 'Service Agent',
                'url' => 'https://developer.chrome.com/blog/private-prefetch-proxy/',
                'producer' => [
                    'name' => 'Google Inc.',
                    'url' => 'https://www.google.com/',
                ],
            ],
            [
                'regex' => 'URLinspectorBot\\/([\\d+.]+)',
                'name' => 'URLinspector',
                'category' => 'Site Monitor',
                'url' => 'https://www.urlinspector.com/bot/',
                'producer' => [
                    'name' => 'LinkResearchTools GmbH',
                    'url' => 'https://www.linkresearchtools.com/',
                ],
            ],
            [
                'regex' => 'EntferBot\\/([\\d+.]+)',
                'name' => 'Entfer',
                'category' => 'Crawler',
                'url' => 'https://entfer.com/',
                'producer' => [
                    'name' => 'Entfer Ltd.',
                    'url' => 'https://entfer.com/',
                ],
            ],
            [
                'regex' => 'TagInspector\\/([\\d+.]+)',
                'name' => 'Tag Inspector',
                'category' => 'Crawler',
                'url' => 'https://taginspector.com/',
                'producer' => [
                    'name' => 'InfoTrust, LLC',
                    'url' => 'https://infotrust.com/',
                ],
            ],
            [
                'regex' => 'pageburst',
                'name' => 'Pageburst',
                'category' => 'Crawler',
                'url' => 'https://pageburstls.elsevier.com/',
                'producer' => [
                    'name' => 'Elsevier Ltd',
                    'url' => 'https://www.elsevier.com/',
                ],
            ],
            [
                'regex' => '.+diffbot',
                'name' => 'Diffbot',
                'category' => 'Crawler',
                'url' => 'https://docs.diffbot.com/docs/getting-started-with-crawl',
                'producer' => [
                    'name' => 'Diffbot Technologies Corp.',
                    'url' => 'https://www.diffbot.com/',
                ],
            ],
            [
                'regex' => 'DisqusAdstxtCrawler\\/([\\d+.]+)',
                'name' => 'Disqus',
                'category' => 'Crawler',
                'url' => 'https://help.disqus.com/en/articles/1765357-ads-txt-implementation-guide',
                'producer' => [
                    'name' => 'Disqus, Inc.',
                    'url' => 'https://disqus.com/',
                ],
            ],
            [
                'regex' => 'startmebot\\/([\\d+.]+)',
                'name' => 'start.me',
                'category' => 'Crawler',
                'url' => 'https://about.start.me/',
                'producer' => [
                    'name' => 'start.me BV',
                    'url' => 'https://about.start.me/',
                ],
            ],
            [
                'regex' => '2ip bot\\/([\\d+.]+)',
                'name' => '2ip',
                'category' => 'Crawler',
                'url' => 'https://2ip.io/',
            ],
            [
                'regex' => 'ReqBin Curl Client\\/([\\d+.]+)',
                'name' => 'ReqBin',
                'category' => 'Crawler',
                'url' => 'https://reqbin.com/curl',
            ],
            [
                'regex' => 'XoviBot\\/([\\d+.]+)',
                'name' => 'XoviBot',
                'category' => 'Crawler',
                'url' => 'https://www.xovibot.net',
                'producer' => [
                    'name' => 'Xovi GmbH',
                    'url' => 'http://www.xovi.de',
                ],
            ],
            [
                'regex' => 'Overcast\\/([\\d+.]+) Podcast Sync',
                'name' => 'Overcast Podcast Sync',
                'category' => 'Service Agent',
                'url' => 'https://overcast.fm/podcasterinfo',
            ],
            [
                'regex' => '^Verity\\/([\\d+.]+)',
                'name' => 'GumGum Verity',
                'category' => 'Service Agent',
                'url' => 'https://gumgum.com/verity',
            ],
            [
                'regex' => 'hackermention',
                'name' => 'hackermention',
                'category' => 'Feed Reader',
                'url' => 'https://github.com/snarfed/hackermention',
            ],
            [
                'regex' => 'BitSightBot\\/([\\d+.]+)',
                'name' => 'BitSight',
                'category' => 'Security Checker',
                'url' => 'https://www.bitsight.com/',
                'producer' => [
                    'name' => 'BitSight Technologies, Inc.',
                    'url' => 'https://www.bitsight.com/',
                ],
            ],
            [
                'regex' => 'Ezgif\\/([\\d+.]+)',
                'name' => 'Ezgif',
                'category' => 'Service Agent',
                'url' => 'https://ezgif.com/about',
            ],
            [
                'regex' => 'intelx.io_bot',
                'name' => 'Intelligence X',
                'category' => 'Crawler',
                'url' => 'https://intelx.io/',
                'producer' => [
                    'name' => 'Kleissner Investments s.r.o.',
                    'url' => 'https://intelx.io/',
                ],
            ],
            [
                'regex' => 'FemtosearchBot\\/([\\d+.]+)',
                'name' => 'Femtosearch',
                'category' => 'Crawler',
                'url' => 'http://femtosearch.com/',
                'producer' => [
                    'name' => 'Grier Forensics, LLC',
                    'url' => 'https://www.grierforensics.com/',
                ],
            ],
            [
                'regex' => 'AdsTxtCrawler\\/([\\d+.]+)',
                'name' => 'AdsTxtCrawler',
                'category' => 'Crawler',
                'url' => 'https://github.com/InteractiveAdvertisingBureau/adstxtcrawler',
                'producer' => [
                    'name' => 'IAB Technology Laboratory, Inc.',
                    'url' => 'https://iabtechlab.com/',
                ],
            ],
            [
                'regex' => 'Morningscore',
                'name' => 'Morningscore Bot',
                'category' => 'Crawler',
                'url' => 'https://morningscore.io/',
                'producer' => [
                    'name' => 'Morningscore',
                    'url' => 'https://morningscore.io/',
                ],
            ],
            [
                'regex' => 'Uptime-Kuma\\/([\\d+.]+)',
                'name' => 'Uptime-Kuma',
                'category' => 'Site Monitor',
                'url' => 'https://github.com/louislam/uptime-kuma',
            ],
            [
                'regex' => 'ChatGPT-User',
                'name' => 'ChatGPT',
                'category' => 'Crawler',
                'url' => 'https://platform.openai.com/docs/plugins/bot',
                'producer' => [
                    'name' => 'OpenAI OpCo, LLC',
                    'url' => 'https://openai.com/',
                ],
            ],
            [
                'regex' => 'BrightEdge Crawler\\/([\\d+.]+)',
                'name' => 'BrightEdge',
                'category' => 'Crawler',
                'url' => 'https://www.brightedge.com/',
                'producer' => [
                    'name' => 'BrightEdge Technologies, Inc',
                    'url' => 'https://www.brightedge.com/',
                ],
            ],
            [
                'regex' => 'sfFeedReader\\/([\\d+.]+)',
                'name' => 'sfFeedReader',
                'url' => 'https://github.com/diem-project/sfFeed2Plugin',
                'category' => 'Feed Fetcher',
            ],
            [
                'regex' => 'cyberscan.io',
                'name' => 'Cyberscan',
                'category' => 'Security Checker',
                'url' => 'https://www.cyberscan.io/',
                'producer' => [
                    'name' => 'DGC Verwaltungs GmbH',
                    'url' => 'https://dgc.org/',
                ],
            ],
            [
                'regex' => 'deepcrawl\\.com',
                'name' => 'Lumar',
                'category' => 'Crawler',
                'url' => 'https://deepcrawl.com/bot',
                'producer' => [
                    'name' => 'Lumar',
                    'url' => 'https://www.lumar.io/',
                ],
            ],
            [
                'regex' => 'RepoLookoutBot',
                'name' => 'Repo Lookout',
                'category' => 'Crawler',
                'url' => 'https://www.repo-lookout.org/',
                'producer' => [
                    'name' => 'Crissy Field GmbH',
                    'url' => 'https://www.crissyfield.de/',
                ],
            ],
            [
                'regex' => 'researchscan.comsys.rwth-aachen.de',
                'name' => 'Research Scan',
                'category' => 'Crawler',
                'url' => 'http://researchscan.comsys.rwth-aachen.de/',
                'producer' => [
                    'name' => 'RWTH Aachen University',
                    'url' => 'https://www.comsys.rwth-aachen.de/',
                ],
            ],
            [
                'regex' => 'newspaper\\/([\\d+.]+)',
                'name' => 'Scraping Robot',
                'category' => 'Crawler',
                'url' => 'https://scrapingrobot.com/',
                'producer' => [
                    'name' => 'Sprious LLC',
                    'url' => 'https://sprious.com/',
                ],
            ],
            [
                'regex' => 'GPTBot\\/([\\d+.]+)',
                'name' => 'GPTBot',
                'category' => 'Crawler',
                'url' => 'https://platform.openai.com/docs/gptbot',
                'producer' => [
                    'name' => 'OpenAI OpCo, LLC',
                    'url' => 'https://openai.com/',
                ],
            ],
            [
                'regex' => 'Ant.com beta\\/([\\d+.]+)',
                'name' => 'Ant',
                'category' => 'Crawler',
                'url' => 'https://www.ant.com/',
                'producer' => [
                    'name' => 'Ant.com Ltd.',
                    'url' => 'https://www.ant.com/',
                ],
            ],
            [
                'regex' => 'WebwikiBot\\/([\\d+.]+)',
                'name' => 'Webwiki',
                'category' => 'Crawler',
                'url' => 'https://www.webwiki.com/',
                'producer' => [
                    'name' => 'webwiki GmbH',
                    'url' => 'https://www.webwiki.com/',
                ],
            ],
            [
                'regex' => '[a-z0-9\\-_]*((?<!cu|power[ _]|m[ _])bot(?![ _]TAB|[ _]?5[0-9]|[ _]Senior|[ _]Junior)|crawler|crawl|checker|archiver|transcoder|spider)([^a-z]|$)',
                'name' => 'Generic Bot',
            ],
        ];
    }
}
