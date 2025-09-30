<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show()
    {
        $users = $this->userService->allUsers();
        return view('users', compact('users'));
    }

    public function show_profile($id)
    {
        $data = $this->userService->userProfile($id);
        return view('user_profile', $data);
    }
}
