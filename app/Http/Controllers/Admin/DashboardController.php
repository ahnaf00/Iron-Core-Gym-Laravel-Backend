<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private DashboardService $dashboardService) {}

    public function stats():JsonResponse
    {
        return $this->success(
            $this->dashboardService->getStats(),
            'Dasboard stats retrieved'
        );
    }
}
