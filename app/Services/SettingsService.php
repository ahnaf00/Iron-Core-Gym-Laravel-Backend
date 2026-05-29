<?php

namespace App\Services;

use App\Models\SiteSetting;

class SettingsService
{
    public function get(string $key, $default = null):mixed
    {
        $setting = SiteSetting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public function set(string $key, string $value):void
    {
        SiteSetting::updateOrCreate(['key' => $key], ['value'=>$value]);
    }

    public function getGroup(string $group):array
    {
        return SiteSetting::where('group',$group)->pluck('value','key')->toArray();
    }

    public function getAll():array
    {
        return SiteSetting::all()->groupBy('group')->map(fn ($items) => $items->pluck('value','key'))->toArray();
    }

    public function updateBulk(array $settings):void
    {
        foreach($settings as $setting)
        {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
