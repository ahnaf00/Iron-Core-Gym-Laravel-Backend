<?php
namespace App\Http\Controllers\PublicApi;
use App\Http\Controllers\Controller;
use App\Http\Resources\MembershipPlanResource;
use App\Models\MembershipPlan;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PricingController extends Controller
{
    use ApiResponseTrait;

    public function index():JsonResponse
    {
        $plans = MembershipPlan::active()->get();
        return $this->success(MembershipPlanResource::collection($plans),'plans retreieved');
    }
}
