<?php

namespace App\Services;

use App\Models\ClassSession;
use App\Models\Member;
use App\Models\Trainer;
use App\Models\ContactMessage;
use App\Models\MembershipPlan;
use Carbon\Carbon;

class DashboardService
{
    public function getStats():array
    {
        $now = Carbon::now();

        return [
            'total_members'             => Member::count(),
            'active_members'            => Member::active()->count(),
            'total_trainers'            => Trainer::active()->count(),
            'total_classes'             => ClassSession::active()->count(),
            'unread_messages'           => ContactMessage::where('is_read',false)->count(),
            'new_members_this_month'    => Member::whereMonth('join_date', $now->month)->whereYear('join_date',$now->year)->count(),
            'revenue_this_month'        => $this->calculateMonthlyRevenue($now),
        ];
    }

    private function calculateMonthlyRevenue(Carbon $date):float
    {
        return (float) Member::active()->whereMonth('join_date','<=', $date->month)->join('membership_plans','members.membership_plan_id','=','membership_plans.id')->sum('membership_plans.price');
    }
}
