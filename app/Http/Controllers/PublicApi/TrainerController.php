<?php

namespace App\Http\Controllers\PublicApi;


use App\Http\Controllers\Controller;
use App\Http\Resources\TrainerResource;
use App\Models\Trainer;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TrainerController extends Controller
{
    use ApiResponseTrait;

    public function index():JsonResponse
    {
        $trainers = Trainer::active()->get();
        return $this->success(TrainerResource::collection($trainers),'Trainers retrieved');
    }
}
