<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        $trainers = [
            ['name' => 'Alex Rodriguez', 'email' => 'alex@ironcoregym.com', 'phone' => '+1 234 567 001', 'specialty' => 'Strength & Conditioning', 'bio' => 'Certified strength coach with 8 years of experience helping athletes reach peak performance.', 'experience_years' => 8, 'is_active' => true],
            ['name' => 'Mia Thompson', 'email' => 'mia@ironcoregym.com', 'phone' => '+1 234 567 002', 'specialty' => 'Yoga & Flexibility', 'bio' => 'Registered yoga instructor specializing in Vinyasa and restorative yoga.', 'experience_years' => 5, 'is_active' => true],
            ['name' => 'Carlos Reyes', 'email' => 'carlos@ironcoregym.com', 'phone' => '+1 234 567 003', 'specialty' => 'CrossFit', 'bio' => 'CrossFit Level 3 trainer and former competitive athlete.', 'experience_years' => 10, 'is_active' => true],
            ['name' => 'Yuki Nakamura', 'email' => 'yuki@ironcoregym.com', 'phone' => '+1 234 567 004', 'specialty' => 'Martial Arts', 'bio' => 'Black belt in Karate and Judo with over a decade of coaching experience.', 'experience_years' => 12, 'is_active' => true],
            ['name' => 'Fiona Walsh', 'email' => 'fiona@ironcoregym.com', 'phone' => '+1 234 567 005', 'specialty' => 'Pilates', 'bio' => 'Pilates instructor focused on core stability and injury rehabilitation.', 'experience_years' => 6, 'is_active' => false],
            ['name' => 'Marcus Bell', 'email' => 'marcus@ironcoregym.com', 'phone' => '+1 234 567 006', 'specialty' => 'Powerlifting', 'bio' => 'Competitive powerlifter and certified personal trainer.', 'experience_years' => 9, 'is_active' => true],
        ];

        foreach ($trainers as $trainer) {
            Trainer::create($trainer);
        }
    }
}
