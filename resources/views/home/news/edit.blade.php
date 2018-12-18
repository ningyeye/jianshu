@extends('home.layout.base')

@section('content')
    <div class="col-sm-8 blog-main">
        <form action="/news/{{$new->id}}" method="POST">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$new->title}}">
            </div>
            <div class="form-group">
                <label>简介</label>
                <textarea id="description" style="height:200px;max-height:500px;" name="description" class="form-control"
                          placeholder="这里是简介">{{$new->description}}</textarea>
            </div>
            <div class="form-group">
                <label>内容</label>
                <div id="editor"></div>
                <textarea id="content" style="height:400px;max-height:500px;display: none" name="content" class="form-control">{{$new->content}}</textarea>
            </div>
            @include('home.layout.error')
            <button type="submit" class="btn btn-default">提交</button>
        </form>
        <br>
    </div>
    <script src="https://unpkg.com/wangeditor@3.1.1/release/wangEditor.min.js"></script>
    <script src="{{asset('static/home/js/home.js')}}"></script>
@endsection