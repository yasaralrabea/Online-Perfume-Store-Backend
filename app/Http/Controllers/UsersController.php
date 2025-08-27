<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class UsersController extends Controller
{
    public function show()
{
    $users= User::all();
        return view('users', compact('users'));
}

public function show_profile($id)
{
    $user = User::findOrFail($id);
    $email=$user->email;
    $orders = Order::withTrashed()->where('email', $email)->get();

    return view('user_profile', compact('user', 'orders'));
}


}
