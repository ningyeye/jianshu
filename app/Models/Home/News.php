<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\SoftDeletes;


class News extends \App\Models\Model
{
    use SoftDeletes;

    protected $table = 'news';

    // 文章关联用户 (因为news表中有user_id所以使用belongsTo)
    public function user()
    {
        return $this->belongsTo('App\Models\Home\User', 'user_id', 'id');
    }

    // 关联评论模型(一对多,一篇文章多个评论)
    public function comments()
    {
        return $this->hasMany('\App\Models\Home\Comment')->orderBy('created_at', 'desc');
    }

    // 关联赞模型
    public function zan($user_id)
    {
        return $this->hasOne('\App\Models\Home\Zan', 'news_id', 'id')->where('user_id', $user_id);
    }

    // 赞数
    public function zans()
    {
        return $this->hasMany('\App\Models\Home\Zan')->orderBy('created_at', 'desc');
    }
}