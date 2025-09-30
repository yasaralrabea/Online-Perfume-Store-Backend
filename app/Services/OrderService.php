<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Models\Product;
use App\Models\User;
use App\Models\ReceivedProduct;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NeworederNotification;
use App\Notifications\UpdateOrderNotification;

class OrderService
{
    protected $orderRepo;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function listOrders($withTrashed = false)
    {
        $orders = $withTrashed ? $this->orderRepo->getAllWithTrashed() : $this->orderRepo->getAll();
        foreach ($orders as $order) {
            $order->cart = json_decode($order->cart, true);
        }
        return $orders;
    }

    public function confirmInfo($data)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        foreach ($cart as $product) {
            $productModel = Product::find($product['id']);
            $productModel->quantity -= $product['quantity'];
            $productModel->save();
        }

        $order = $this->orderRepo->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'cart' => json_encode($cart),
        ]);

        $user->notify(new NeworederNotification($user->name));
        session()->forget('cart');

        return $order;
    }

    public function updateStatus($id, $status, $delete = false)
    {
        $order = $this->orderRepo->find($id);
        $user = User::where('email', $order->email)->first();

        $order->condition = $status;
        $order->save();

        $user->notify(new UpdateOrderNotification($user->name, $order->condition));

        if ($delete) {
            $this->orderRepo->delete($order);
        }

        return $order;
    }

    public function deliverOrder($id)
    {
        $order = $this->orderRepo->find($id);
        $user = User::where('email', $order->email)->first();
        $cartItems = json_decode($order->cart, true);

        foreach ($cartItems as $item) {
            ReceivedProduct::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['id'],
                'order_id' => $order->id,
                'quantity' => $item['quantity'] ?? 1,
            ]);

            $product = Product::find($item['id']);
            $product->number_of_sales += $item['quantity'];
            $product->save();
        }

        $order->condition = 'done';
        $order->save();

        $user->notify(new UpdateOrderNotification($user->name, $order->condition));
        $this->orderRepo->delete($order);

        return $order;
    }

    public function myOrders()
    {
        $email = Auth::user()->email;
        return \App\Models\Order::withTrashed()->where('email', $email)->get();
    }
}
