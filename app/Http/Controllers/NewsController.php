<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function Termwind\render;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = new NewsCollection(News::OrderByDesc('id')->paginate(10));
        return Inertia::render('Homepage', [
            'title' => 'Berita Day',
            'description' => 'Selamat Datang di Portal Berita Day',
            'news' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;
        $news->category = $request->category;
        $news->author = Auth::user()->name;
        $news->save();

        return redirect()->back()->with('message', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $myNews = $news::where('author', auth()->user()->name)->get();
        return Inertia::render('Dashboard', [
            'myNews' => $myNews
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news, Request $request)
    {
        // $editNews = News::where('author', auth()->user()->name);

        return Inertia::render('EditNews', [
            'myNews' => $news::find($request->id)
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        News::where('id', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category
        ]);

        return redirect()->route('my.news')->with('message', 'Berita berita diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news, Request $request)
    {
        $news = News::where('id', $request->id);
        $news->delete();

        return redirect()->back()->with('message', 'Berita berhasil dihapus!');
    }
}
