<?php

namespace App\Models\Home;

class Fan extends \App\Models\Model
{

    // 粉丝用户
    public function fuser()
    {
        return $this->hasOne('\App\Models\Home\User', 'id', 'fan_id');
    }

    // 关注用户
    public function suser()
    {
        return $this->hasOne('\App\Models\Home\User', 'id', 'star_id');
    }

}
