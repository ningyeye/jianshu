<?php

namespace App\Http\Controllers;

use App\Models\Home\Comment;
use App\Models\Home\News;
use App\Models\Home\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use \App\Libs\Coreseek\SphinxClient;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class NewsController extends Controller
{
    protected $ck;

    public function __construct()
    {
        $this->ck = new SphinxClient();
        $this->ck->SetServer('127.0.0.1', 9312);
        $this->ck->SetSortMode(SPH_SORT_ATTR_DESC, "created_at");
        $this->ck->SetMatchMode(SPH_MATCH_EXTENDED);
    }

    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->withCount(['comments', 'zans'])->paginate(15);
        return view('home.news.index', compact('news'));
    }

    public function show(News $new)
    {
        // 在控制器层渲染数据,因为在视图层会查询一次数据(避免操作数据库)
        $new->load('comments');
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

    public function comment(News $new)
    {
        $this->validate(request(), [
            'content' => 'required|min:3',
        ]);

        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $new->comments()->save($comment);

        return redirect('/news');
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

    public function zan(News $new)
    {
        $param = [
            'user_id' => \Auth::id(),
            'news_id' => $new->id
        ];
        Zan::firstOrCreate($param);
        return back();
    }

    public function unzan(News $new)
    {
        $new->zan(\Auth::id())->delete();
        return back();
    }

    public function search()
    {
        // 验证
        $this->validate(request(), [
            'query' => 'required'
        ]);
        // 逻辑
        $query = request('query');
        $page = request('page') ? intval(request('page')) : 1;
        $this->ck->SetLimits(($page - 1) * 10, 10);
        $res = $this->ck->Query($query, 'js_news');
        $total = $res['total'];
        $ids = array();
        if (empty($res['matches'])){
            return redirect('/news');
        }
        foreach ($res["matches"] as $key => $arr) {
            $ids[] = intval($key);
        }
        $news = News::whereIn('id', $ids)->get();

        $opts = array("before_match" =>"<font color='#FF4939'>","after_match" =>"</font>", "chunk_separator" =>"...","limit" =>100,"around" =>256);
        foreach($news as $key=>$val)
        {
            $row=$this->ck->BuildExcerpts(array($val->title,$val->description),'mysql',$query,$opts);
            $val->title = $row[0];
            $val->description = $row[1];
        }

        $paginator = new LengthAwarePaginator($news, $total, 10, $page, [
            'path' => Paginator::resolveCurrentPath(),                // 注释2
            'pageName' => 'page'
        ]);
        $paginator->appends(['query' => $query]);


        //$news = News::where('title', 'like', '%' . $query . '%')->paginate(10);
        // 渲染
        return view('home.news.search', compact('query', 'news', 'paginator', 'total'));
    }

}