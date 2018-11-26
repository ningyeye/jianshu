<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    /**
     * 不允许批量赋值的字段
     * @var array
     */
    protected $guarded = [];
}
