<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    public function run(): void
    {
        MembershipPlan::create([
            'name' => 'Basic',
            'duration_month' => 1,
            'price' => 29.00,
            'features' => [
                'Access to gym floor',
                'Locker room access',
                'Free fitness assessment',
                '2 Group classes / week',
            ],
            'is_popular' => false,
            'is_active' => true,
        ]);

        MembershipPlan::create([
            'name' => 'Premium',
            'duration_month' => 1,
            'price' => 59.00,
            'features' => [
                'Everything in Basic',
                'Unlimited group classes',
                'Access to sauna & spa',
                '1 Personal training session / month',
                'Nutrition consultation',
            ],
            'is_popular' => true,
            'is_active' => true,
        ]);

        MembershipPlan::create([
            'name' => 'Elite',
            'duration_month' => 1,
            'price' => 99.00,
            'features' => [
                'Everything in Premium',
                '4 Personal training sessions / month',
                'Custom meal plan',
                'Priority class booking',
                'Guest passes (2 / month)',
                'Exclusive member events',
            ],
            'is_popular' => false,
            'is_active' => true,
        ]);
    }
}
