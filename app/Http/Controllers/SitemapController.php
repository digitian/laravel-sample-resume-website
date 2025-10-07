<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function show(): Response
    {

        $sm = Sitemap::create();

        // helper to add a page with its alternates (TR/EN/DE)
        $add = function (string $tr, string $en, string $de, ?Carbon $lastmod = null) use ($sm) {
            $lastmod = $lastmod ?? now();
            $xDefault = $tr;

            // TR
            $sm->add(
                Url::create(url($tr))
                    ->setLastModificationDate($lastmod)
                    ->addAlternate(url($en), 'en')
                    ->addAlternate(url($de), 'de')
                    ->addAlternate(url($tr), 'tr')
                    ->addAlternate(url($xDefault), 'x-default')
                    
            );
            // EN
            $sm->add(
                Url::create(url($en))
                    ->setLastModificationDate($lastmod)
                    ->addAlternate(url($tr), 'tr')
                    ->addAlternate(url($de), 'de')
                    ->addAlternate(url($en), 'en')
                    ->addAlternate(url($xDefault), 'x-default')
            );
            // DE
            $sm->add(
                Url::create(url($de))
                    ->setLastModificationDate($lastmod)
                    ->addAlternate(url($tr), 'tr')
                    ->addAlternate(url($en), 'en')
                    ->addAlternate(url($de), 'de')
                    ->addAlternate(url($xDefault), 'x-default')
            );
        };

        // Static pages
        $add('/',                 '/en',               '/de');
        $add('/hakkimda',         '/en/about-me',      '/de/uber-mich');
        $add('/iletisim',         '/en/contact',       '/de/kontakt');
        $add('/blog',             '/en/blog',          '/de/blog');
        $add('/portfolyo',        '/en/portfolio',     '/de/portfolio');

        // Dynamic: BLOG posts (you create TR/EN/DE per parent_id)
        Post::query()
            ->select(['slug', 'locale', 'updated_at', 'parent_id'])
            ->where('status', 1)
            ->orderByDesc('updated_at')
            ->get()
            ->groupBy('parent_id')
            ->each(function ($group) use ($add) {
                // map slugs to full localized paths
                $paths = [
                    'tr' => optional($group->firstWhere('locale', 'tr'), fn($p) => "/blog/{$p->slug}"),
                    'en' => optional($group->firstWhere('locale', 'en'), fn($p) => "/en/blog/{$p->slug}"),
                    'de' => optional($group->firstWhere('locale', 'de'), fn($p) => "/de/blog/{$p->slug}"),
                ];
                // pick a lastmod (latest among the trio)
                $lastmod = $group->max('updated_at');

                if ($paths['tr'] && $paths['en'] && $paths['de']) {
                    $add($paths['tr'], $paths['en'], $paths['de'], Carbon::parse($lastmod));
                } else {
                    // if any locale missing, just add the ones that exist (no alternates)
                    foreach ($group as $p) {
                        $prefix = $p->locale === 'tr' ? '' : "/{$p->locale}";
                        $sm->add(
                            Url::create(url("$prefix/blog/{$p->slug}"))
                                ->setLastModificationDate($p->updated_at)
                        );
                    }
                }
            });

        // Dynamic: PORTFOLIO items (same pattern)
        Portfolio::query()
            ->select(['slug', 'locale', 'updated_at', 'parent_id'])
            ->where('status', 1)
            ->orderByDesc('updated_at')
            ->get()
            ->groupBy('parent_id')
            ->each(function ($group) use ($add, $sm) {
                $paths = [
                    'tr' => optional($group->firstWhere('locale', 'tr'), fn($p) => "/portfolyo/{$p->slug}"),
                    'en' => optional($group->firstWhere('locale', 'en'), fn($p) => "/en/portfolio/{$p->slug}"),
                    'de' => optional($group->firstWhere('locale', 'de'), fn($p) => "/de/portfolio/{$p->slug}"),
                ];
                $lastmod = $group->max('updated_at');

                if ($paths['tr'] && $paths['en'] && $paths['de']) {
                    $add($paths['tr'], $paths['en'], $paths['de'], Carbon::parse($lastmod));
                } else {
                    foreach ($group as $p) {
                        $prefix = $p->locale === 'tr' ? '' : "/{$p->locale}";
                        $sm->add(
                            Url::create(url("$prefix/portfolio/{$p->slug}"))
                                ->setLastModificationDate($p->updated_at)
                        );
                    }
                }
            });

        // Done: send XML response with proper headers (pretty-printed)
        return $sm->toResponse(request()); // Content-Type: application/xml

    }
}
