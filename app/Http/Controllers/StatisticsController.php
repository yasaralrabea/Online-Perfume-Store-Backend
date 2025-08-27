<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class StatisticsController extends Controller
{
    public function top()
    {


        $product = Product::orderBy('number_of_sales', 'desc')->first();
         $popular_perfumes = Product::orderBy('number_of_sales', 'desc')->take(5)->get();

        $top_one=$product->name;
        $items = $product->number_of_sales;
       

        $users_num = User::count();
    return compact('top_one', 'items', 'popular_perfumes', 'users_num');


    }

}
