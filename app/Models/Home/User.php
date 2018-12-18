<?php

namespace App\Models\Home;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login_at', 'ip'
    ];

    // 用户的文章列表
    public function news()
    {
        return $this->hasMany('\App\Models\Home\News', 'user_id', 'id');
    }

    // 关注我的（我的粉丝）
    public function fans()
    {
        return $this->hasMany('\App\Models\Home\Fan', 'star_id', 'id');
    }

    // 我的关注
    public function stars()
    {
        return $this->hasMany('\App\Models\Home\Fan', 'fan_id', 'id');
    }

    // 关注某人
    public function doFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        $this->stars()->save($fan);
    }

    // 取消关注
    public function doUnFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        $this->stars()->delete($fan);
    }

    // 当前用户是否被uid关注了
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id',$uid)->count();
    }

    // 当前用户是否关注了uid
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }

}
