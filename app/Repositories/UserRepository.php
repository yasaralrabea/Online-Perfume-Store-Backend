<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Order;

class UserRepository
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function findUserById($id)
    {
        return User::findOrFail($id);
    }

    public function getUserOrders($email)
    {
        return Order::withTrashed()->where('email', $email)->get();
    }
}
