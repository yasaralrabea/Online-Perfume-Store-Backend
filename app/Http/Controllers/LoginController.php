<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view("auth/login");
    }
    
    public function register()
    {
        return view("auth/register");
    }
}
