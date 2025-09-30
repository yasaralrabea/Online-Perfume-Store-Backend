<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $cart= session()->get('cart', []);
      

        return view("cart", compact('cart'));
    }



    public function add(Request $request, $id)
    {
        $product=Product::find($id);

        $cart = session()->get('cart', []);
        
        $amount=(int)$request->query('quantity',1);
        if( $amount<1)
        {
            $amount=1;
        }
    
        if(isset($cart[$id]))
        {
            $cart[$id]["quantity"]+=$amount;
        }
        else
        {
            $cart[$id]=['id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $amount,
            'user_id'=>Auth::id(),
            'image' => $product->image,];
        }
        
        session()->put('cart', $cart);
    return redirect()->back()->with('success', 'تم إضافة المنتج للسلة');


    }

    public function delete($id)
    {
         $cart = session()->get('cart', []);
                unset($cart[$id]);
        session()->put('cart', $cart);

    }
    public function confirm()
    {
        $cart= session()->get('cart', []);

        $user = Auth::user();
        return view('confirm', [
    'cart' => $cart,
    'user' => $user

]);
        return redirect()->back()->with('success', 'تم تأكيد الطلب  بنجاح');

    }


    public function confirmOrder(Request $request)
    {
        $payment=$request->input('payment_method');
        
        if($payment=='visa')
        {
            return view('visa');
        }
        else{

                    $user = Auth::user();

            return view('info_to_receive',['user'=>$user,]);
        }

    }
    
}