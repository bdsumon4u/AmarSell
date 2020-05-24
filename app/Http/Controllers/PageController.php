<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = cache('pages', function () {
            $pages = Page::all();
            $pages->each(function ($page) {
                cache(["page.{$page->slug}" => $page]);
            });
            cache(['pages' => $pages]);
            return $pages;
        });
        return view('admin.pages.index', [
            'pages' => $pages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:pages',
            'slug' => 'required|unique:pages',
            'content' => 'required',
        ]);

        $page = Page::create($data);
        cache(["page.{$page->slgu}" => $page]);
        return redirect()->back()->with('success', 'Page Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($page)
    {
        $page = cache("page.$page", function () use ($page) {
            return Page::where('slug', $page)->last();
        });
        return view('page', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($page)
    {
        $page = cache("page.$page", function () use ($page) {
            return Page::where('slug', $page)->first();
        });
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'required|unique:pages,id,' . $page->id,
            'title' => 'required|unique:pages,id,' . $page->id,
            'content' => 'required',
        ]);
        $page->update($data);

        return redirect()->back()->with('success', 'Page Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back()->with('success', 'Page Deleted Successfull.');
    }
}
