<?php

namespace App\Http\Controllers;

use App\Models\Home\News;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        // 验证
        $this->validate($request, [
            'title' => 'required|max:255|min:4',
            'description' => 'required|max:255|min:10',
            'content' => 'required|min:100',
        ]);
        $new = News::create(request(['title', 'description', 'content']));
        return redirect('/news');
    }

    public function edit()
    {
        return view('home.news.edit');
    }

}