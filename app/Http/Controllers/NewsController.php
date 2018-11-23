<?php

namespace App\Http\Controllers;

use App\Models\Home\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //验证
        $this->validate($request, [
            'title' => 'required|max:255|min:4',
            'description' => 'required|max:255|min:10',
            'content' => 'required|min:100',
        ]);
        $user_id = \Auth::id();
        $param = array_merge(request(['title', 'description', 'content']), compact('user_id'));
        if (News::create($param)) {
            return redirect('/news');
        }
    }

    public function edit(News $new)
    {
        return view('home.news.edit', compact('new'));
    }

    public function update(News $new)
    {
        $this->validate(request(), [
            'title' => 'required|max:255|min:4',
            'description' => 'required|max:255|min:10',
            'content' => 'required|min:100',
        ]);

        $this->authorize('update', $new);

        $new->title = request('title');
        $new->description = request('description');
        $new->content = request('content');
        if ($new->save()) {
            return redirect('/news/' . $new->id);
        }
    }

    public function delete(News $new)
    {
        $this->authorize('delete', $new);
        if ($new->delete()) {
            return redirect('/news');
        }
    }

    public function imageUpload(Request $request)
    {
        //判断请求中是否包含name=file的上传文件
        if (!$request->hasFile('files')) {
            exit('上传文件为空！');
        }
        $files = $request->file('files');
        //定义返回数组
        $resArr = [];
        foreach ($files as $file) {
            //判断文件上传过程中是否出错
            if (!$file->isValid()) {
                exit('文件上传出错！');
            }
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $realPath = $file->getRealPath();
            $fileName = date('Ymd') . '_' . md5(uniqid($name)) . '.' . $ext;
            Storage::disk('uploads')->put($fileName, file_get_contents($realPath));
            $resArr[]['path'] = '/uploads/' . $fileName;
        }
        return $res = [
            'res' => $resArr,
            'status' => 0
        ];
    }

}