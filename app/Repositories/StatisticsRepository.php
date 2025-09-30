<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\User;

class StatisticsRepository
{
    public function topProduct()
    {
        return Product::orderBy('number_of_sales', 'desc')->first();
    }

    public function popularProducts($limit = 5)
    {
        return Product::orderBy('number_of_sales', 'desc')->take($limit)->get();
    }

    public function usersCount()
    {
        return User::count();
    }
}
