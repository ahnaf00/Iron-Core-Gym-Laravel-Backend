<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMembershipPlanRequest;
use App\Http\Requests\UpdateMembershipPlanRequest;
use App\Http\Resources\MembershipPlanResource;
use App\Services\MembershipPlanService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MembershipPlanController extends Controller
{
    use ApiResponseTrait;
    public function __construct(private MembershipPlanService $planService){}
    
    public function index(Request $request):JsonResponse
    {
        $plans = $this->planService->list($request->all());
        return $this->paginated(
            MembershipPlanResource::collection($plans)->resource,
            'Plan retrieved'
        );
    }

    public function store(StoreMembershipPlanRequest $request):JsonResponse
    {
        $plan = $this->planService->create($request->validated());
        return $this->success(new MembershipPlanResource($plan),'Plan created');
    }

    public function show(int $id):JsonResponse
    {
        $plan = $this->planService->find($id);
        return $this->success(new MembershipPlanResource($plan), 'Plan retrieved');
    }

    public function update(UpdateMembershipPlanRequest $request, int $id):JsonResponse
    {
        $plan = $this->planService->update($id, $request->validated());
        return $this->success(new MembershipPlanResource($plan),'plan updated');
    }

    public function destroy(int $id):JsonResponse
    {
        $this->planService->delete($id);
        return $this->success(null, 'Plan deleted');
    }
}
