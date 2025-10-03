<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $portfolios = Portfolio::where('locale', 'tr')->select('id', 'title', 'images', 'created_at', 'updated_at', 'status')->latest()->get();
        return view('admin.modules.portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.modules.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title_tr' => ['required', 'string', 'max: 255'],
            'content_tr' => ['required', 'string', 'max: 500'],
            'description_tr' => ['required', 'string', 'max: 500'],
            'title_en' => ['required', 'string', 'max: 255'],
            'content_en' => ['required', 'string', 'max: 500'],
            'description_en' => ['required', 'string', 'max: 500'],
            'title_de' => ['required', 'string', 'max: 255'],
            'content_de' => ['required', 'string', 'max: 500'],
            'description_de' => ['required', 'string', 'max: 500'],
            'images'     => ['required','array','min:1','max:20'],
            'images.*'   => ['file','mimes:jpg,jpeg,png,webp,avif,gif','max:5120'],
            'features_tr'   => ['nullable','array','max:100'],
            'features_tr.*' => ['string','min:1','max:200','distinct:ignore_case'],
            'features_en'   => ['nullable','array','max:100'],
            'features_en.*' => ['string','min:1','max:200','distinct:ignore_case'],
            'features_de'   => ['nullable','array','max:100'],
            'features_de.*' => ['string','min:1','max:200','distinct:ignore_case'],
            'category' => ['required', 'in:project,web-template,ui'],
            'stage' => ['required', 'in:inprogress,completed,canceled'],
            'status' =>  ['boolean'],
        ]);

        $paths = [];
        foreach ($request->file('images', []) as $file) {
            $paths[] = $file->store('portfolio', 'public'); // adjust disk/path as needed
        }

        $basePortfolio = Portfolio::create([
            'author_id' => Auth::id(),
            'title' => $request->title_tr,
            'content' => $request->content_tr,
            'description' => $request->description_tr,
            'features' => $request->features_tr,
            'slug' => \Str::slug($request->title_tr),
            'images' => $paths,
            'stage' => $request->stage,
            'category' => $request->category,
            'status' => $request->status ? 1 : 0,
            'locale' => 'tr',
        ]);

        Portfolio::create([
            'author_id' => Auth::id(),
            'title' => $request->title_en,
            'content' => $request->content_en,
            'description' => $request->description_en,
            'features' => $request->features_en,
            'slug' => \Str::slug($request->title_en),
            'images' => $paths,
            'stage' => $request->stage,
            'category' => $request->category,
            'status' => $request->status ? 1 : 0,
            'parent_id' => $basePortfolio->id,
            'locale' => 'en',
        ]);

        Portfolio::create([
            'author_id' => Auth::id(),
            'title' => $request->title_de,
            'content' => $request->content_de,
            'description' => $request->description_de,
            'features' => $request->features_de,
            'slug' => \Str::slug($request->title_de),
            'images' => $paths,
            'stage' => $request->stage,
            'category' => $request->category,
            'status' => $request->status ? 1 : 0,
            'parent_id' => $basePortfolio->id,
            'locale' => 'de',
        ]);

        notyf()->success(__('admin.portfolio_created'));

        return redirect()->route('admin.portfolio.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $portfolio_tr = Portfolio::findOrFail($id);
        $portfolio_en = Portfolio::where('locale', 'en')->where('parent_id', $portfolio_tr->id)->firstOrFail();
        $portfolio_de = Portfolio::where('locale', 'de')->where('parent_id', $portfolio_tr->id)->firstOrFail();

        return view('admin.modules.portfolio.edit', compact('portfolio_tr', 'portfolio_en', 'portfolio_de'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'title_tr' => ['required', 'string', 'max: 255'],
            'content_tr' => ['required', 'string', 'max: 500'],
            'description_tr' => ['required', 'string', 'max: 500'],
            'title_en' => ['required', 'string', 'max: 255'],
            'content_en' => ['required', 'string', 'max: 500'],
            'description_en' => ['required', 'string', 'max: 500'],
            'title_de' => ['required', 'string', 'max: 255'],
            'content_de' => ['required', 'string', 'max: 500'],
            'description_de' => ['required', 'string', 'max: 500'],
            // 'images'     => ['array','min:1','max:20'],
            // 'images.*'   => ['file','mimes:jpg,jpeg,png,webp,avif,gif','max:5120'],
            'features_tr'   => ['nullable','array','max:100'],
            'features_tr.*' => ['string','min:1','max:200','distinct:ignore_case'],
            'features_en'   => ['nullable','array','max:100'],
            'features_en.*' => ['string','min:1','max:200','distinct:ignore_case'],
            'features_de'   => ['nullable','array','max:100'],
            'features_de.*' => ['string','min:1','max:200','distinct:ignore_case'],
            'stage' => ['required', 'in:inprogress,completed,canceled'],
            'category' => ['required', 'in:project,web-template,ui'],
            'status' =>  ['boolean'],
        ]);

        $portfolio_tr = Portfolio::findOrFail($id);

        $portfolio_tr->title = $request->title_tr;
        $portfolio_tr->content = $request->content_tr;
        $portfolio_tr->description = $request->description_tr;
        $portfolio_tr->features = $request->features_tr;
        $portfolio_tr->stage = $request->stage;
        $portfolio_tr->category = $request->category;
        $portfolio_tr->status = $request->status ? 1 : 0;
        $portfolio_tr->save();

        $portfolio_en = Portfolio::where('parent_id', $portfolio_tr->id)->where('locale', 'en')->firstOrFail();
        $portfolio_en->title = $request->title_en;
        $portfolio_en->content = $request->content_en;
        $portfolio_en->description = $request->description_en;
        $portfolio_en->features = $request->features_en;
        $portfolio_en->stage = $request->stage;
        $portfolio_en->category = $request->category;
        $portfolio_en->status = $request->status ? 1 : 0;
        $portfolio_en->save();

        $portfolio_de = Portfolio::where('parent_id', $portfolio_tr->id)->where('locale', 'de')->firstOrFail();
        $portfolio_de->title = $request->title_de;
        $portfolio_de->content = $request->content_de;
        $portfolio_de->description = $request->description_de;
        $portfolio_de->features = $request->features_de;
        $portfolio_de->stage = $request->stage;
        $portfolio_de->category = $request->category;
        $portfolio_de->status = $request->status ? 1 : 0;
        $portfolio_de->save();

        notyf()->success(__('admin.portfolio_updated'));

        return redirect()->route('admin.portfolio.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio_tr = Portfolio::findOrFail($id);
        $portfolio_en = Portfolio::where('locale', 'en')->where('parent_id', $id)->firstOrFail();
        $portfolio_de = Portfolio::where('locale', 'de')->where('parent_id', $id)->firstOrFail();

        notyf()->info('"' . $portfolio_tr->title . '"     ' . __('admin.has_deleted'));

        $portfolio_tr->delete();
        $portfolio_en->delete();
        $portfolio_de->delete();

        return redirect()->route('admin.portfolio.index');
    }
}
