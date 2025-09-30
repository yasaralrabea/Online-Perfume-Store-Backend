<?php

namespace App\Services;

use App\Repositories\StatisticsRepository;

class StatisticsService
{
    protected $statisticsRepo;

    public function __construct(StatisticsRepository $statisticsRepo)
    {
        $this->statisticsRepo = $statisticsRepo;
    }

    public function topStatistics()
    {
        $topProduct = $this->statisticsRepo->topProduct();
        $popularProducts = $this->statisticsRepo->popularProducts();
        $usersCount = $this->statisticsRepo->usersCount();

        return [
            'top_one' => $topProduct ? $topProduct->name : null,
            'items' => $topProduct ? $topProduct->number_of_sales : 0,
            'popular_perfumes' => $popularProducts,
            'users_num' => $usersCount
        ];
    }
}
