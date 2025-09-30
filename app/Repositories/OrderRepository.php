<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function getAll()
    {
        return Order::all();
    }

    public function getAllWithTrashed()
    {
        return Order::withTrashed()->get();
    }

    public function find($id)
    {
        return Order::find($id);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function update(Order $order, array $data)
    {
        $order->update($data);
        return $order;
    }

    public function delete(Order $order)
    {
        return $order->delete();
    }

    public function getUserOrders($email)
    {
        return Order::withTrashed()->where('email', $email)->get();
    }


}
