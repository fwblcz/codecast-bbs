<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //show 方法用来处理个人页面的展示
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

}
