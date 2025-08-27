<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
   


    public function admin_page()
    {
      $statsController = new StatisticsController();
      $stats = $statsController->top();

          return view('control_page', $stats);
     
    }

    public function home()
    {
         $products = Product::orderBy('id', 'desc')->paginate(10);

         $popular_perfumes = Product::orderBy('number_of_sales', 'desc')->take(5)->get();

          if (request()->ajax()) {
        return view('partials', compact('products'))->render();}

          return view('home',compact('popular_perfumes','products'));
    }

}



