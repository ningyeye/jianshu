<?php

namespace App\Http\Controllers;

use App\Models\Home\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // 设置页面
    public function setting()
    {
        return view('home.user.setting');
    }

    // 个人设置行为
    public function settingStore()
    {

    }

    // 个人主页
    public function show(User $user)
    {
        // 获取这个人的信息，包含关注/粉丝/文章数
        $user = User::withCount(['stars', 'fans', 'news'])->find($user->id);

        // 获取改用户10篇的文章
        $news = $user->news()->orderBy('created_at', 'desc')->take(10)->get();

        // 获取该用户所有的粉丝
        $fans = $user->fans;
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'news'])->get();


        // 获取该用户所有的关注
        $stars = $user->stars;
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars', 'fans', 'news'])->get();

        return view('home.user.show', compact('user','news', 'susers', 'fusers'));
    }

    // 关注
    public function fan(User $user)
    {
        $me = \Auth::user();
        $me->doFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];


    }

    // 取消关注
    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me->doUnFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];
    }
}
