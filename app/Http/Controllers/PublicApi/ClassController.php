<?php

namespace App\Http\Controllers\PublicApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassSessionResource;
use App\Models\ClassSession;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ClassController extends Controller
{
    use ApiResponseTrait;

    public function index():JsonResponse
    {
        $classes = ClassSession::active()->with('trainer')->get();
        return $this->success(ClassSessionResource::collection($classes), 'Classes retrieved');
    }
}
