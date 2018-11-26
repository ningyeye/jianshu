<?php

namespace App\Models\Home;

class Comment extends \App\Models\Model
{
    public function news()
    {
        return $this->belongsTo('\App\Models\Home\News', 'news_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\Home\User', 'user_id', 'id');
    }
}