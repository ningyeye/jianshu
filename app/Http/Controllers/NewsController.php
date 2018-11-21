<?php

namespace App\Http\Controllers;

use App\Models\Home\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(15);
        return view('home.news.index', compact('news'));
    }

    public function show(News $new)
    {
        return view('home.news.show', compact('new'));
    }

    public function create()
    {
        return view('home.news.create');
    }

    public function store()
    {

    }

    public function edit()
    {
        return view('home.news.edit');
    }

}