<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rate;


class ProductsController extends Controller
{

     public function products_show($id)
     {
          
          $rates=Rate::where('product_id',$id)->get();
          $topReviews = Rate::where('product_id', $id)->orderByDesc('rating')->take(5)->get();

          $getproduct = Product::find($id);
          return view("product" , compact('getproduct','rates','topReviews'));
     }
    public function men()
    {
         $menProducts = Product::where('sex', 'male')->get();
    return view('men', compact('menProducts'));
    }    
    
    public function women()
    {
         $womenProducts = Product::where('sex', 'female')->get();
    return view('women', compact('womenProducts'));
    }    

    
    public function every()
    {
         $every = Product::all();
    return view('every', compact('every'));
    }    
 
      public function showAddForm()
      {
          return view('add_product');
      }

    public function add_product(Request $request)
    {
     

$product = Product::create([
    'name' => $request->name,
    'code' => $request->code,
    'sex' => $request->sex,
    'special' => $request->special,
    'price' => $request->price,
    'image' => $request->image,
    'ml' => $request->ml,
    'quantity' => $request->quantity,
    'special' => $request->special,
    'description' => $request->description,

    
]);   
        return redirect()->back()->with('success', 'تم إضافة المنتج ');

 }



    public function search(Request $request)
{
    $query = Product::query();

    if($request->name){
        $query->where('name', 'like', '%' . $request->name . '%');
    }
    if($request->gender){
        $query->where('sex', $request->gender);
    }
   
    

    $products = $query->get();
    return response()->json($products);
}

}
