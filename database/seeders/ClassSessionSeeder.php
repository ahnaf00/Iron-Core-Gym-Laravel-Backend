<?php

namespace Database\Seeders;

use App\Models\ClassSession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassSessionSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            ['name' => 'Power Lifting', 'trainer_id' => 1, 'category' => 'Strength', 'schedule_day' => 'Monday', 'schedule_time' => '07:00', 'duration_minutes' => 60, 'capacity' => 20, 'is_active' => true],
            ['name' => 'Morning Yoga', 'trainer_id' => 2, 'category' => 'Flexibility', 'schedule_day' => 'Tuesday', 'schedule_time' => '06:00', 'duration_minutes' => 60, 'capacity' => 15, 'is_active' => true],
            ['name' => 'CrossFit WOD', 'trainer_id' => 3, 'category' => 'CrossFit', 'schedule_day' => 'Wednesday', 'schedule_time' => '08:00', 'duration_minutes' => 60, 'capacity' => 25, 'is_active' => true],
            ['name' => 'Kickboxing', 'trainer_id' => 4, 'category' => 'Combat', 'schedule_day' => 'Thursday', 'schedule_time' => '18:00', 'duration_minutes' => 60, 'capacity' => 20, 'is_active' => true],
            ['name' => 'Pilates Core', 'trainer_id' => 5, 'category' => 'Flexibility', 'schedule_day' => 'Friday', 'schedule_time' => '09:00', 'duration_minutes' => 60, 'capacity' => 12, 'is_active' => false],
            ['name' => 'Deadlift Mastery', 'trainer_id' => 6, 'category' => 'Strength', 'schedule_day' => 'Saturday', 'schedule_time' => '10:00', 'duration_minutes' => 90, 'capacity' => 10, 'is_active' => true],
            ['name' => 'Flexibility Flow', 'trainer_id' => 2, 'category' => 'Flexibility', 'schedule_day' => 'Sunday', 'schedule_time' => '08:00', 'duration_minutes' => 60, 'capacity' => 18, 'is_active' => true],
            ['name' => 'HIIT Burn', 'trainer_id' => 3, 'category' => 'Cardio', 'schedule_day' => 'Monday', 'schedule_time' => '18:00', 'duration_minutes' => 60, 'capacity' => 20, 'is_active' => true],
        ];

        foreach ($classes as $class) {
            ClassSession::create(array_merge($class, [
                'slug' => Str::slug($class['name']),
                'description' => 'Join our ' . $class['name'] . ' class led by experienced trainers to push your limits.',
            ]));
        }
    }
}
