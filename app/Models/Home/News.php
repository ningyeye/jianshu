<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';

    /**
     * 不允许批量赋值的字段
     * @var array
     */
    protected $guarded = [];

    // 文章关联用户 (因为news表中有user_id所以使用belongsTo)
    public function user()
    {
        return $this->belongsTo('App\Models\Home\User', 'user_id', 'id');
    }
}