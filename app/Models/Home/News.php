<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    /**
     * 不允许批量赋值的字段
     * @var array
     */
    protected $guarded = [];
}