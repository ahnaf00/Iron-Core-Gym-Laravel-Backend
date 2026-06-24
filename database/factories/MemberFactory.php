<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\MembershipPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $planId = MembershipPlan::inRandomOrder()->first()->id ?? 1;

        return [
            'name'               => fake()->name(),
            'email'              => fake()->unique()->safeEmail(),
            'phone'              => fake()->phoneNumber(),
            'address'            => fake()->address(),
            'membership_plan_id' => $planId,
            'join_date'          => fake()->dateTimeBetween('-1 year', 'now'),
            'status'             => fake()->randomElement(['active', 'active', 'inactive', 'expired']), // Weighted towards active
            'photo'              => null,
        ];
    }
}
