<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Order;
use App\Models\ReceivedProduct;
use Illuminate\Support\Facades\Auth;

class RatesController extends Controller
{
   public function store(Request $request)

{
    $rate = Rate::where('user_id', Auth::id())->where('product_id', $request->id)->first();

    if($rate) {
                 return redirect()->back()->with('error', 'عذرا لا يمكنك التقييم مرة أخرى.');
         }
    else{
    $receivedProduct = ReceivedProduct::where([
        ['user_id', Auth::id()],
        ['product_id', $request->id]
    ])->first();

    if (!$receivedProduct) {
        return redirect()->back()
            ->with('error', 'عذرا لا يمكنك التقييم لأنك لم تشتر المنتج من قبل.');
    }

    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:500',
    ]);

    Rate::create([
        'product_id' => $request->id,
        'user_id' => Auth::id(),
        'comment' => $request->comment,
        'rating' => $request->rating,
    ]);

    return redirect()->back()->with('success', 'تم إرسال التقييم');
    }
}



}
