<?php
/**
 * Created by PhpStorm.
 * User: Li Ning
 * Date: 2018/11/15
 * Time: 17:46
 */

namespace App\Admin\Controllers;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }
}