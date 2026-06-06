<?php

namespace App\Http\Controllers\PublicApi;
use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SettingsController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private SettingsService $settingsService){}

    public function index():JsonResponse
    {
        return $this->success(
            $this->settingsService->getAll(),
            'settings retrieved'
        );
    }
}
