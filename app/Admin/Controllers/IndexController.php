<?php
/**
 * Created by PhpStorm.
 * User: Li Ning
 * Date: 2018/11/15
 * Time: 17:49
 */

namespace App\Admin\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.admin.index');
    }
}