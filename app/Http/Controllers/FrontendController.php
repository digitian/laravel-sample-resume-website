<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FrontendController extends Controller
{
    public function index(): View {

        $locale = App::currentLocale();

        $services = Service::where('locale', $locale)->where('status', 1)->get();

        return view('home', compact('services'));
    }

    public function about(): View {
        return view('about');
    }

    public function contact(): View {
        return view('contact');
    }

    public function blog(): View {
        $locale = App::currentLocale();

        $posts = Post::where('locale', $locale)->where('status', 1)->paginate(10);
        $posts->appends(['sort' => 'sort']);
        return view('blog', compact('posts'));
    }

    public function viewpost(String $slug): View {
        $locale = App::currentLocale();
        
        $post = Post::where('locale', $locale)->where('slug', $slug)->firstOrFail();

        
        $similarPosts = Post::where('locale', $locale)->where('id', '!=', $post->id)->inRandomOrder()->limit(5)->select('id', 'slug', 'title', 'image', 'description')->get();

        $prevPost = Post::where('locale', $locale)
            ->where('status', 1)
            ->where('id', '<', $post->id)
            ->orderByDesc('id')
            ->select('slug')
            ->first()
        ?? Post::where('locale', $locale)
            ->where('status', 1)
            ->where('id', '!=', $post->id)
            ->orderByDesc('id')   // last one
            ->select('slug')
            ->first();

        $prevPostSlug = $prevPost->slug;

        // Next (id just above current); if none, wrap to the lowest id (not current)
        $nextPost = Post::where('locale', $locale)
            ->where('status', 1)
            ->where('id', '>', $post->id)
            ->orderBy('id')
            ->select('slug')
            ->first()
        ?? Post::where('locale', $locale)
            ->where('status', 1)
            ->where('id', '!=', $post->id)
            ->orderBy('id')
            ->select('slug')
            ->first();

        $nextPostSlug = $nextPost->slug;
        
        $postTr = Post::where('locale', 'tr')->where('parent_id', $post->parent_id)->first();
        $postTrSlug = $postTr->slug;
        
        $postEn = Post::where('locale', 'en')->where('parent_id', $post->parent_id)->first();
        $postEnSlug = $postEn->slug;

        $postDe = Post::where('locale', 'de')->where('parent_id', $post->parent_id)->first();
        $postDeSlug = $postDe->slug;

        return view('post-view', compact('post', 'similarPosts', 'prevPostSlug', 'nextPostSlug', 'postTrSlug', 'postEnSlug', 'postDeSlug'));
    }

    public function portfolio(): View {
        $locale = App::currentLocale();

        $portfolios = Portfolio::where('locale', $locale)->where('status', 1)
        ->select('id', 'slug', 'images', 'title', 'category', 'description')->get();

        return view('portfolios', compact('portfolios'));
    }

    public function viewportfolio(String $slug): View {
        $locale = App::currentLocale();
        
        $portfolio = Portfolio::where('locale', $locale)->where('slug', $slug)->firstOrFail();

        $portfolioTr = Portfolio::where('locale', 'tr')->where('parent_id', $portfolio->parent_id)->first();
        $portfolioTrSlug = $portfolioTr->slug;
        
        $portfolioEn = Portfolio::where('locale', 'en')->where('parent_id', $portfolio->parent_id)->first();
        $portfolioEnSlug = $portfolioEn->slug;

        $portfolioDe = Portfolio::where('locale', 'de')->where('parent_id', $portfolio->parent_id)->first();
        $portfolioDeSlug = $portfolioDe->slug;

        $category = $portfolio->category === 'project' ? __('portfolio.project') : ($portfolio->category === 'web-template' ? __('portfolio.web_template') : __('portfolio.ui_element'));

        $prevPortfolio = Portfolio::where('locale', $locale)
            ->where('status', 1)
            ->where('id', '<', $portfolio->id)
            ->orderByDesc('id')
            ->select('slug')
            ->first()
        ?? Portfolio::where('locale', $locale)
            ->where('status', 1)
            ->where('id', '!=', $portfolio->id)
            ->orderByDesc('id')
            ->select('slug')
            ->first();

        $prevPortfolioSlug = $prevPortfolio->slug;

        $nextPortfolio = Portfolio::where('locale', $locale)
            ->where('status', 1)
            ->where('id', '>', $portfolio->id)
            ->orderBy('id')
            ->select('slug')
            ->first()
        ?? Portfolio::where('locale', $locale)
            ->where('status', 1)
            ->where('id', '!=', $portfolio->id)
            ->orderBy('id')
            ->select('slug')
            ->first();

        $nextPortfolioSlug = $nextPortfolio->slug;

        return view('portfolio-view', compact('portfolio', 'portfolioTrSlug', 'portfolioEnSlug', 'portfolioDeSlug', 'category', 'prevPortfolioSlug', 'nextPortfolioSlug'));
    }
}
