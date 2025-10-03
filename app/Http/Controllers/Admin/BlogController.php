<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $blogs = Post::where('locale', 'tr')->select('id', 'slug', 'title', 'content', 'image', 'created_at', 'status')->latest()->get();

        return view('admin.modules.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.modules.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_tr' => ['required', 'string', 'max: 255'],
            'description_tr' => ['required', 'string', 'max: 1000'],
            'content_tr' => ['required', 'string', 'max: 5000'],
            'keywords_tr' => ['string', 'max: 255'],
            'category_tr' => ['string', 'max: 50'],
            'title_en' => ['required', 'string', 'max: 255'],
            'description_en' => ['required', 'string', 'max: 1000'],
            'content_en' => ['required', 'string', 'max: 5000'],
            'keywords_en' => ['string', 'max: 255'],
            'category_en' => ['string', 'max: 50'],
            'title_de' => ['required', 'string', 'max: 255'],
            'description_de' => ['required', 'string', 'max: 1000'],
            'content_de' => ['required', 'string', 'max: 5000'],
            'keywords_de' => ['string', 'max: 255'],
            'category_de' => ['string', 'max: 50'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,avif,gif', 'max: 5120'],
            'status' =>  ['boolean'],
        ]);

        $imgPath = $request->file('image')->store('blog', 'public');

        $basePost = Post::create([
            'author_id' => Auth::id(),
            'title' => $request->title_tr,
            'description' => $request->description_tr,
            'content' => $request->content_tr,
            'keywords' => $request->keywords_tr,
            'category' => $request->category_tr,
            'status' => $request->status ? 1 : 0,
            'image' => $imgPath,
            'slug' => \Str::slug($request->title_tr),
            'locale' => 'tr',
        ]);

        Post::create([
            'author_id' => Auth::id(),
            'title' => $request->title_en,
            'description' => $request->description_en,
            'content' => $request->content_en,
            'keywords' => $request->keywords_en,
            'category' => $request->category_en,
            'status' => $request->status ? 1 : 0,
            'image' => $imgPath,
            'slug' => \Str::slug($request->title_en),
            'locale' => 'en',
            'parent_id' => $basePost->id,
        ]);

        Post::create([
            'author_id' => Auth::id(),
            'title' => $request->title_de,
            'description' => $request->description_de,
            'content' => $request->content_de,
            'keywords' => $request->keywords_de,
            'category' => $request->category_de,
            'status' => $request->status ? 1 : 0,
            'image' => $imgPath,
            'slug' => \Str::slug($request->title_de),
            'locale' => 'de',
            'parent_id' => $basePost->id,
        ]);

        notyf()->success(__('admin.post_created'));

        return redirect()->route('admin.blog.index');
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
        $post_tr = Post::findOrFail($id);
        $post_en = Post::where('locale', 'en')->where('parent_id', $post_tr->id)->firstOrFail();
        $post_de = Post::where('locale', 'de')->where('parent_id', $post_tr->id)->firstOrFail();

        return view('admin.modules.blog.edit', compact('post_tr', 'post_en', 'post_de'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title_tr' => ['required', 'string', 'max: 255'],
            'description_tr' => ['required', 'string', 'max: 1000'],
            'content_tr' => ['required', 'string', 'max: 5000'],
            'keywords_tr' => ['string', 'max: 255'],
            'category_tr' => ['string', 'max: 50'],
            'title_en' => ['required', 'string', 'max: 255'],
            'description_en' => ['required', 'string', 'max: 1000'],
            'content_en' => ['required', 'string', 'max: 5000'],
            'keywords_en' => ['string', 'max: 255'],
            'category_en' => ['string', 'max: 50'],
            'title_de' => ['required', 'string', 'max: 255'],
            'description_de' => ['required', 'string', 'max: 1000'],
            'content_de' => ['required', 'string', 'max: 5000'],
            'keywords_de' => ['string', 'max: 255'],
            'category_de' => ['string', 'max: 50'],
            'image' => ['file', 'mimes:jpg,jpeg,png,webp,avif,gif', 'max: 5120'],
            'status' =>  ['boolean'],
        ]);

        
        $post_tr = Post::findOrFail($id);
        $post_en = Post::where('parent_id', $post_tr->id)->where('locale', 'en')->firstOrFail();
        $post_de = Post::where('parent_id', $post_tr->id)->where('locale', 'de')->firstOrFail();
        
        if ($request->file('image')) {
            $imgPath = $request->file('image')->store('blog', 'public');

            $post_tr->image = $imgPath;
            $post_en->image = $imgPath;
            $post_de->image = $imgPath;
        }

        $post_tr->title = $request->title_tr;
        $post_tr->description = $request->description_tr;
        $post_tr->content = $request->content_tr;
        $post_tr->keywords = $request->keywords_tr;
        $post_tr->category = $request->category_tr;
        $post_tr->slug = \Str::slug($request->title_tr);
        $post_tr->save();

        $post_en->title = $request->title_en;
        $post_en->description = $request->description_en;
        $post_en->content = $request->content_en;
        $post_en->keywords = $request->keywords_en;
        $post_en->category = $request->category_en;
        $post_en->slug = \Str::slug($request->title_en);
        $post_en->save();

        $post_de->title = $request->title_de;
        $post_de->description = $request->description_de;
        $post_de->content = $request->content_de;
        $post_de->keywords = $request->keywords_de;
        $post_de->category = $request->category_de;
        $post_de->slug = \Str::slug($request->title_de);
        $post_de->save();

        notyf()->success(__('admin.post_updated'));

        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post_tr = Post::findOrFail($id);
        $post_en = Post::where('locale', 'en')->where('parent_id', $id)->firstOrFail();
        $post_de = Post::where('locale', 'de')->where('parent_id', $id)->firstOrFail();

        notyf()->info('"' . $post_tr->title . '"     ' . __('admin.has_deleted'));

        $post_tr->delete();
        $post_en->delete();
        $post_de->delete();

        return redirect()->route('admin.blog.index');
    }
}
