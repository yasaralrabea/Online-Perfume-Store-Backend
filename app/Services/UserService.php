<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function allUsers()
    {
        return $this->userRepo->getAllUsers();
    }

    public function userProfile($id)
    {
        $user = $this->userRepo->findUserById($id);
        $orders = $this->userRepo->getUserOrders($user->email);

        return compact('user', 'orders');
    }
}
