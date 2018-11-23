<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // 页面
    public function index()
    {
        return view('home.login.index');
    }


    // 登入
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            // 验证
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:5|max:10',
                'is_remember' => 'integer'
            ]);
            $user = $request->only(['email', 'password']);
            $remember = boolval($request->get('is_remember'));
            // 逻辑
            if (\Auth::attempt($user, $remember)) {
                // 这个用户被记住了...
                return redirect('/news');
            } else {
                return \Redirect::back()->withErrors('邮箱密码不匹配!');
            }
        }
    }

    // 登出
    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}