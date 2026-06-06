<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Http\Requests\UpdateSettingsRequest;
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
            'Settings retrieved'
        );
    }

    public function update(UpdateSettingsRequest $request):JsonResponse
    {
        $this->settingsService->updateBulk($request->validated()['settings']);
        return $this->success(
            $this->settingsService->getAll(),
            'Settings updated'
        );
    }
}
