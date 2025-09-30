<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;

class StatisticsController extends Controller
{
    protected $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function top()
    {
        $data = $this->statisticsService->topStatistics();
        return $data; 
    }
}
