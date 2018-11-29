@extends("home.layout.base")

@section("content")

    <div class="alert alert-success" role="alert">
        下面是搜索"{{$query}}"出现的文章，{{$total}}条
    </div>

    <div class="col-sm-8 blog-main">
        @foreach($news as $new)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="/news/{{$new->id}}">{!! $new->title !!}</a></h2>
                <p class="blog-post-meta">{{$new->created_at->toFormattedDateString()}} by <a href="/user/{{$new->user_id}}">{{$new->user->name}}</a></p>
                <p>{!! str_limit($new->description, 200, '...') !!}</p>
            </div>
        @endforeach
        {{$paginator}}
        {{--{{$news->appends(['query'=>$query])->links()}}--}}
    </div><!-- /.blog-main -->

@endsection