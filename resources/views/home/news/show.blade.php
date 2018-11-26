@extends('home.layout.base')

@section('content')
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{$new->title}}</h2>
                @can('update',$new)
                    <a style="margin: auto" href="/news/{{$new->id}}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                @endcan
                @can('delete',$new)
                    <a style="margin: auto" href="/news/{{$new->id}}/delete">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                @endcan
            </div>

            <p class="blog-post-meta">{{$new->created_at->toFormattedDateString()}} by <a href="/user/{{$new->user_id}}">{{$new->user->name}}</a></p>
            <p>{!! $new->content !!}</p>
            <div>
                <a href="/news/{{$new->id}}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                <a href="/news/{{$new->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                @foreach($new->comments as $comment)
                    <li class="list-group-item">
                        <h5>{{$comment->created_at}} By {{$comment->user->name}}</h5>
                        <div>
                            {{$comment->content}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="/news/{{$new->id}}/comment" method="POST">
                    {{csrf_field()}}
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        @include('home.layout.error')
                        <button class="btn btn-default" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->
@endsection