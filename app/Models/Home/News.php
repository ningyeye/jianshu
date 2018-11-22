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
}