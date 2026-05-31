<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Resources\MemberResource;
use App\Services\MemberService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use ApiResponseTrait;
    public function __construct(private MemberService $memberService) {}

    public function index(Request $request):JsonResponse
    {
        $members = $this->memberService->list($request->all());
        return $this->paginated(
            MemberResource::collection($members)->resource,
            'Members retrieved'
        );
    }

    public function store(StoreMemberRequest $request):JsonResponse
    {
        $member = $this->memberService->create($request->validated());
        return $this->success(
            new MemberResource($member->load('membershipPlan')),
            'Member created',
            201
        );
    }

    public function show(int $id):JsonResponse
    {
        $member = $this->memberService->find($id);
        return $this->success(new MemberResource($member), 'Member retrieved');
    }

    public function update(UpdateMemberRequest $request, int $id):JsonResponse
    {
        $member = $this->memberService->update($id, $request->validated());
        return $this->success(new MemberResource($member),'Member updated');
    }

    public function destroy(int $id):JsonResponse
    {
        $this->memberService->delete($id);
        return $this->success(null,'Member deleted');
    }
}
