<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('home.news.index');
    }

    public function show()
    {
        return view('home.news.show');
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