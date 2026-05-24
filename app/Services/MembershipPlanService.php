<?php

namespace App\Services;

use App\Models\MembershipPlan;
use Illuminate\Pagination\LengthAwarePaginator;


class MembershipPlanService
{
    public function list(array $filters = []):LengthAwarePaginator
    {
        $query = MembershipPlan::withCount('members');

        if(isset($filters['is_active']))
        {
            $query->where('is_active', $filters['is_active']);
        }

        return $query->orderBy('price')->paginate($filters['per_page'] ?? 15);
    }

    public function find(int $id):MembershipPlan
    {
        return MembershipPlan::withCount('members')->findOrFail($id);
    }

    public function create(array $data):MembershipPlan
    {
        return MembershipPlan::create($data);
    }

    public function update(int $id, array $data):MembershipPlan
    {
        $plan = MembershipPlan::findOrFail($id);
        $plan->update($data);
        return $plan->fresh();
    }

    public function delete(int $id):void
    {
        MembershipPlan::findOrFail($id)->delete();
    }
}
