<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $services = Service::where('locale', 'tr')->select('id', 'title', 'created_at', 'updated_at', 'status')->latest()->get();
        return view('admin.modules.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.modules.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title_tr' => ['required', 'string', 'max: 255'],
            'content_tr' => ['required', 'string', 'max: 500'],
            'title_en' => ['required', 'string', 'max: 255'],
            'content_en' => ['required', 'string', 'max: 500'],
            'title_de' => ['required', 'string', 'max: 255'],
            'content_de' => ['required', 'string', 'max: 500'],
            'status' =>  ['boolean'],
        ]);
        
        // Turkish
        $baseService = Service::create([
            'author_id' => Auth::id(),
            'title' => $request->title_tr,
            'content' => $request->content_tr,
            'status' => $request->status ? 1 : 0,
            'locale' => 'tr',
        ]);

        // English
        Service::create([
            'author_id' => Auth::id(),
            'title' => $request->title_en,
            'content' => $request->content_en,
            'status' => $request->status ? 1 : 0,
            'locale' => 'en',
            'parent_id' => $baseService->id,
        ]);

        Service::create([
            'author_id' => Auth::id(),
            'title' => $request->title_de,
            'content' => $request->content_de,
            'status' => $request->status ? 1 : 0,
            'locale' => 'de',
            'parent_id' => $baseService->id,
        ]);

        notyf()->success(__('admin.service_created'));

        return redirect()->route('admin.services.index');

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
    public function edit(string $id): View
    {
        $service_tr = Service::findOrFail($id);
        $service_en = Service::where('locale', 'en')->where('parent_id', $service_tr->id)->firstOrFail();
        $service_de = Service::where('locale', 'de')->where('parent_id', $service_tr->id)->firstOrFail();

        return view('admin.modules.services.edit', compact('service_tr', 'service_en', 'service_de'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'title_tr' => ['required', 'string', 'max: 255'],
            'content_tr' => ['required', 'string', 'max: 500'],
            'title_en' => ['required', 'string', 'max: 255'],
            'content_en' => ['required', 'string', 'max: 500'],
            'title_de' => ['required', 'string', 'max: 255'],
            'content_de' => ['required', 'string', 'max: 500'],
            'status' =>  ['boolean'],
        ]);

        $service_tr = Service::findOrFail($id);
        $service_tr->title = $request->title_tr;
        $service_tr->content = $request->content_tr;
        $service_tr->status = $request->status ? 1 : 0;
        $service_tr->save();

        $service_en = Service::where('locale', 'en')->where('parent_id', $id)->firstOrFail();
        $service_en->title = $request->title_en;
        $service_en->content = $request->content_en;
        $service_en->status = $request->status ? 1 : 0;
        $service_en->save();

        $service_de = Service::where('locale', 'de')->where('parent_id', $id)->firstOrFail();
        $service_de->title = $request->title_de;
        $service_de->content = $request->content_de;
        $service_de->status = $request->status ? 1 : 0;
        $service_de->save();

        notyf()->success(__('admin.service_updated'));

        return redirect()->route('admin.services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $service_tr = Service::findOrFail($id);
        $service_en = Service::where('locale', 'en')->where('parent_id', $id)->firstOrFail();
        $service_de = Service::where('locale', 'de')->where('parent_id', $id)->firstOrFail();

        notyf()->info('"' . $service_tr->title . '"     ' . __('admin.has_deleted'));

        $service_tr->delete();
        $service_en->delete();
        $service_de->delete();

        return redirect()->route('admin.services.index');
    }
}
