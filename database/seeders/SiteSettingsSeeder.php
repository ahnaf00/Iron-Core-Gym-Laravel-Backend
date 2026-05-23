<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'gym_name', 'value' => 'Iron Core Gym', 'group' => 'general'],
            ['key' => 'tagline', 'value' => 'Forge Your Strength', 'group' => 'general'],

            // Contact
            ['key' => 'email', 'value' => 'info@ironcoregym.com', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '+1 (800) 555-0199', 'group' => 'contact'],
            ['key' => 'address', 'value' => '247 Steel Avenue, New York, NY 10001', 'group' => 'contact'],

            // Social
            ['key' => 'instagram', 'value' => 'https://instagram.com/ironcoregym', 'group' => 'social'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/ironcoregym', 'group' => 'social'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/ironcoregym', 'group' => 'social'],
            ['key' => 'youtube', 'value' => '', 'group' => 'social'],

            // Hours (stored as JSON string)
            ['key' => 'hours_monday', 'value' => json_encode(['open' => true, 'from' => '06:00', 'to' => '22:00']), 'group' => 'hours'],
            ['key' => 'hours_tuesday', 'value' => json_encode(['open' => true, 'from' => '06:00', 'to' => '22:00']), 'group' => 'hours'],
            ['key' => 'hours_wednesday', 'value' => json_encode(['open' => true, 'from' => '06:00', 'to' => '22:00']), 'group' => 'hours'],
            ['key' => 'hours_thursday', 'value' => json_encode(['open' => true, 'from' => '06:00', 'to' => '22:00']), 'group' => 'hours'],
            ['key' => 'hours_friday', 'value' => json_encode(['open' => true, 'from' => '06:00', 'to' => '21:00']), 'group' => 'hours'],
            ['key' => 'hours_saturday', 'value' => json_encode(['open' => true, 'from' => '08:00', 'to' => '20:00']), 'group' => 'hours'],
            ['key' => 'hours_sunday', 'value' => json_encode(['open' => false, 'from' => '09:00', 'to' => '17:00']), 'group' => 'hours'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }
    }
}
