<?php

namespace App\Models\Home;

class Fan extends \App\Models\Model
{
<<<<<<< HEAD
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
=======
    public function fuser()
    {
        return $this->belongsTo('\App\Models\User', 'fan_id', 'id');
    }

    public function suser()
    {
        return $this->belongsTo('\App\Models\User', 'star_id', 'id');
    }

>>>>>>> 0cca49faec7a844eea8aa3e84bf3de03d3c6d1ac
}
