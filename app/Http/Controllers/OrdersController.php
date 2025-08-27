<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ReceivedProduct;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller  
{
    
    public function show()
{
    $orders= Order::all();
    
foreach ($orders as $order) {
    $order->cart = json_decode($order->cart, true); 
}
        return view('orders', compact('orders'));
}

public function all_orders()
{
$orders = Order::withTrashed()->get();
    
foreach ($orders as $order) {
    $order->cart = json_decode($order->cart, true); 
}
        return view('orders', compact('orders'));
}


    public function confirmInfo(Request $request)
    {
     
        $cart = session()->get('cart', []);
        
       foreach($cart as $product)
       {
        $product_i =Product::find($product['id']);
        $product_i->quantity+=$product['quantity'];
        $product_i->save();
       }

    $order = Order::create([
    'name' => $request->name,
    'email' => $request->email,
        'phone' => $request->phone,
    'address' => $request->address,

    'cart' => json_encode($cart),  


    ]);    

     session()->forget('cart');


    }

    public function cancel($id)
    {
     $order=Order::find($id);
     $order->condition='cancelled';
     $order->save();
     $order->delete();   
     return redirect()->back()->with('success', 'تم إلغاء الطلب بنجاح.');

    }

    public function preparing($id)
    {
        $order=Order::find($id);
        $order->condition='preparing';
         $order->save();
        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');

    }
     public function delivering($id)
    {
        $order=Order::find($id);
        $order->condition='delivering';
         $order->save();
        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');

    }

     public function deliverd($id)
    {
        $order = Order::find($id);


    $cartItems = json_decode($order->cart, true);


       foreach ($cartItems as $item) {

       ReceivedProduct::create([
        'user_id' => $item['user_id'],
        'product_id' => $item['id'],
        'order_id' => $order->id,
        'quantity' => $item['quantity'] ?? 1,
   ]);


          $product=Product::find($item['id']);
        
          $product->number_of_sales+=$item['quantity'] ;
          $product->save();
       }
     $order->condition='done';
     
     $order->save();
     $order->delete();

     

     return redirect()->back()->with('success', 'تم توصيل الطلب بنجاح.');
    }

    public function my_orders()
    {
        $email = Auth::user()->email;

    $orders = Order::withTrashed()->where('email', $email)->get();
        return view('my_orders', compact('orders'));
    }

    

}
