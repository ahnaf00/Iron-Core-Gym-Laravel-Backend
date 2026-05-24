<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class MemberService
{
    public function list(array $filters = []): LengthAwarePaginator
    {
        $query = Member::with('membershipPlan');

        if(!empty($filters['search']))
        {
            $search = $filters['search'];
            $query->where(function($q) use ($search){
                $q->where('name','like', "%{$search}%")->orWhere('email','like',"%{$search}%");
            });
        }

        if(!empty($filters['status']))
        {
            $query->where('status',$filters['status']);
        }

        return $query->latest()->paginate($filters['per_page'] ?? 15);
    }

    public function find(int $id):Member
    {
        return Member::with('membershipPlan')->findOrFail($id);
    }

    public function create(array $data):Member
    {
        if(isset($data['photo']))
        {
            $data['photo'] = $data['photo']->store('members','public');
        }

        return Member::create($data);
    }

    public function update(int $id, array $data):Member
    {
        $member = Member::findOrFail($id);

        if(isset($data['photo']))
        {
            if($member->photo)
            {
                Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $data['photo']->store('members','public');
        }

        $member->update($data);
        return $member->fresh('membershipPlan');
    }

    public function delete(int $id):void
    {
        $member = Member::findOrFail($id);
        if($member->photo)
        {
            Storage::disk('public')->delete($member->photo);
        }
        $member->delete();
    }
}
