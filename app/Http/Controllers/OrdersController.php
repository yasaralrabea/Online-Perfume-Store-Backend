<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class OrdersController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function show()
    {
        $orders = $this->orderService->listOrders();
        return view('orders', compact('orders'));
    }

    public function all_orders()
    {
        $orders = $this->orderService->listOrders(true);
        return view('orders', compact('orders'));
    }
public function confirmInfo(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:500',
    ]);

    $this->orderService->confirmInfo($request->all());

return redirect()->route('my.orders')->with('success', 'تم تأكيد الطلب بنجاح.');
}


    public function cancel($id)
    {
        $this->orderService->updateStatus($id, 'cancelled', true);
        return redirect()->back()->with('success', 'تم إلغاء الطلب بنجاح.');
    }

    public function preparing($id)
    {
        $this->orderService->updateStatus($id, 'preparing');
        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }

    public function delivering($id)
    {
        $this->orderService->updateStatus($id, 'delivering');
        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }

    public function deliverd($id)
    {
        $this->orderService->deliverOrder($id);
        return redirect()->back()->with('success', 'تم توصيل الطلب بنجاح.');
    }

    public function my_orders()
    {
        $orders = $this->orderService->myOrders();
        return view('my_orders', compact('orders'));
    }
}
