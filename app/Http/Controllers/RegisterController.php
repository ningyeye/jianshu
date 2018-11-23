<?php

namespace App\Http\Controllers;

use App\Models\Home\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // 页面
    public function index()
    {
        return view('home.register.index');
    }

    // 行为
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:2|unique:users,name',
                'email' => 'required|unique:users,email|email',
                'password' => 'required|min:5|max:10|confirmed',
            ]);
        }
        $password = bcrypt(request('password'));
        $name = request('name');
        $email = request('email');
        if (User::create(compact('name', 'email', 'password'))) {
            return redirect('/login');
        }
    }
}