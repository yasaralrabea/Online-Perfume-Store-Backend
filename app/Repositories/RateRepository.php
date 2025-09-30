<?php

namespace App\Repositories;

use App\Models\Rate;
use App\Models\ReceivedProduct;
use Illuminate\Support\Facades\Auth;

class RateRepository
{
    public function findUserRate($userId, $productId)
    {
        return Rate::where('user_id', $userId)->where('product_id', $productId)->first();
    }

    public function create(array $data)
    {
        return Rate::create($data);
    }

    public function receivedProductExists($userId, $productId)
    {
        return ReceivedProduct::where([
            ['user_id', $userId],
            ['product_id', $productId],
        ])->exists();
    }
}
