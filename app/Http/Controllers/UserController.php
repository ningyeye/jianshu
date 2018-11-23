<?php

namespace App\Http\Controllers;

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
    public function show()
    {
        return view('home.user.show');
    }
}
