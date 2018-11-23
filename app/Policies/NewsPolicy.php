<?php

namespace App\Policies;

use App\Models\Home\News;
use App\Models\Home\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 修改权限
    public function update(User $user, News $new)
    {
        return $user->id == $new->user_id;
    }

    //删除权限
    public function delete(User $user, News $new)
    {
        return $user->id == $new->user_id;
    }

}
