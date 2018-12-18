@extends('home.layout.base')

@section('content')
    <div class="col-sm-8">
        <blockquote>
            <p>
                <img src="https://www.douxie.com/statics/newdximages/images/logo2.png" alt="" style="border-radius:500px; height: 30px">
                {{$user->name}}
            </p>
            @if($user->id != \Auth::id())
                <div>
                    @if(\Auth::user()->hasStar($user->id))
                        <button class="btn btn-default like-button" like-value="1" like-user="{{$user->id}}" type="button">
                            取消关注
                        </button>
                    @else
                        <button class="btn btn-default like-button" like-value="0" like-user="{{$user->id}}" type="button">
                            关注
                        </button>
                    @endif
                </div>
            @endif
            <footer>关注：{{$user->stars_count or '0'}}|粉丝：{{$user->fans_count or '0'}}|文章：{{$user->news_count or '0'}}</footer>
        </blockquote>
    </div>

    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($news as $new)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="/user/{{$new->user->id}}">{{$new->user->name}}</a> {{$new->created_at->diffForHumans()}}</p>
                            <p class=""><a href="/news/{{$new->id}}">{{$new->title}}</a></p>
                            <p>
                            <p>{!! str_limit($new->description, 100, '...') !!}</p>
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @foreach($susers as $user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$user->name}}</p>
                            <p class="">关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->news_count}}</p>

                            @if($user->id != \Auth::id())
                                <div>
                                    @if(\Auth::user()->hasStar($user->id))
                                        <button class="btn btn-default like-button" like-value="1" like-user="{{$user->id}}" type="button">
                                            取消关注
                                        </button>
                                    @else
                                        <button class="btn btn-default like-button" like-value="0" like-user="{{$user->id}}" type="button">
                                            关注
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @foreach($fusers as $user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$user->name}}</p>
                            <p class="">关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->news_count}}</p>

                            @if($user->id != \Auth::id())
                                <div>
                                    @if(\Auth::user()->hasStar($user->id))
                                        <button class="btn btn-default like-button" like-value="1" like-user="{{$user->id}}" type="button">
                                            取消关注
                                        </button>
                                    @else
                                        <button class="btn btn-default like-button" like-value="0" like-user="{{$user->id}}" type="button">
                                            关注
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


    </div><!-- /.blog-main -->
@endsection