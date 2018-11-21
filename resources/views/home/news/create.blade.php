@extends('home.layout.base')

@section('content')
    <div class="col-sm-8 blog-main">
        <form action="/news" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                <label>简介</label>
                <textarea id="description" style="height:200px;max-height:500px;" name="description" class="form-control" placeholder="这里是简介"></textarea>
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content" style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
            </div>
            @if(count($errors))
                <div class="xuan" role="alert">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <button type="submit" class="btn btn-default">提交</button>
        </form>
        <br>
    </div>
@endsection