@extends('home.layout.base')

@section('content')
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">做最美的中国人</h2>
                <a style="margin: auto" href="/posts/1/edit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
            </div>

            <p class="blog-post-meta">2018-10-01 by <a href="#">猪八戒</a></p>

            <p>【斗蟹资讯】今天给大家带来一个重磅消息，沙盒剧情RPG手游《单机三国》正式在App Store上线啦!
                数十位三国武将免费获取;独创的沙盒剧情，攻城掠地的同时深刻感受三国乱世;高自由度养成玩法，打造专属自己的强力军团;神兵、秘宝、专属装备，满足你的收集乐趣;驰骋沙场、称王称帝，更有丰富皇宫玩法等你体验!
                『四方群雄挥剑直指洛阳』

                《单机三国》延续了经典的三国人物背景特点，全新剧情不拘泥于典故。辽阔的世界版图任你探索，再度重现九州城池。由于上古魔神蚩尤逃出，附于董卓之身，并借此施以暴政为祸人间，使得各地民不聊生，魏、蜀、吴、群雄四方势力均不堪其扰，为解救苍生于水火之中，只得联手作战。从四面八方向皇城洛阳进发，一路收复城池，邀请能臣战将。
                而玩家作为从未来时空被召唤前来击败蚩尤的主力，将带着诸葛亮、司马懿、周瑜三国军师赠予的封将录踏上寻武将、收城池的征程。首战攻打的便是新野/江陵/武陵三地之一，自此依照魏、蜀、吴三国地图分布，一路披荆斩棘，挥剑直指皇城洛阳。</p>
            <div>
                <a href="/posts/1/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                <a href="/posts/1/zan" type="button" class="btn btn-primary btn-lg">赞</a>
            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <h5>好看</h5>
                    <div>
                        了防腐剂了
                    </div>
                </li>
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="/posts/comment" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="post_id" value="1"/>
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        <button class="btn btn-default" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->
@endsection