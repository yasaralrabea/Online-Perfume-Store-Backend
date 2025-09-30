<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function showProduct($id)
    {
        $product = $this->productRepo->find($id);
        $rates = $this->productRepo->getRates($id);
        $topReviews = $this->productRepo->getTopRates($id);

        return compact('product', 'rates', 'topReviews');
    }

    public function getProductsBySex($sex)
    {
        return $this->productRepo->getBySex($sex);
    }

    public function getAllProducts()
    {
        return $this->productRepo->getAll();
    }

    public function addProduct(array $data)
    {
        return $this->productRepo->create($data);
    }

    public function search(array $filters)
    {
        return $this->productRepo->search($filters);
    }
}
