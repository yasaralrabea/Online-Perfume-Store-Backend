<?php

namespace App\Services;

use App\Repositories\RateRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RateService
{
    protected $rateRepo;

    public function __construct(RateRepository $rateRepo)
    {
        $this->rateRepo = $rateRepo;
    }

    public function storeRate(array $data)
    {
        $userId = Auth::id();
        $productId = $data['id'];

        if ($this->rateRepo->findUserRate($userId, $productId)) {
            throw ValidationException::withMessages([
                'error' => 'عذرا لا يمكنك التقييم مرة أخرى.'
            ]);
        }

        if (!$this->rateRepo->receivedProductExists($userId, $productId)) {
            throw ValidationException::withMessages([
                'error' => 'عذرا لا يمكنك التقييم لأنك لم تشتر المنتج من قبل.'
            ]);
        }

        validator($data, [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ])->validate();

        return $this->rateRepo->create([
            'product_id' => $productId,
            'user_id' => $userId,
            'comment' => $data['comment'] ?? null,
            'rating' => $data['rating'],
        ]);
    }
}
