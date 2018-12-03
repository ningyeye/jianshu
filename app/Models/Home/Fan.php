<?php

namespace App\Models\Home;

class Fan extends \App\Models\Model
{
    public function fuser()
    {
        return $this->belongsTo('\App\Models\User', 'fan_id', 'id');
    }

    public function suser()
    {
        return $this->belongsTo('\App\Models\User', 'star_id', 'id');
    }

}
