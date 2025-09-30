<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Rate;

class ProductRepository
{
    public function find($id)
    {
        return Product::find($id);
    }

    public function getAll()
    {
        return Product::all();
    }

    public function getBySex($sex)
    {
        return Product::where('sex', $sex)->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function getRates($productId)
    {
        return Rate::where('product_id', $productId)->get();
    }

    public function getTopRates($productId, $limit = 5)
    {
        return Rate::where('product_id', $productId)
                    ->orderByDesc('rating')
                    ->take($limit)
                    ->get();
    }

    public function search(array $filters)
    {
        $query = Product::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['gender'])) {
            $query->where('sex', $filters['gender']);
        }

        return $query->get();
    }
}
