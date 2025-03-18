<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{

    // protected $user;

    // public function __construct($user)
    // {
    //     $this->user = $user;
    // }

    public function getAllSettings()
    {
        $settingData = Setting::first();

        $executives = [];
        if ($settingData && isset($settingData->executives)) {
            if (is_array($settingData->executives)) {
                $limitedExecutives = array_slice($settingData->executives,0,4);
                foreach ($limitedExecutives as $executive) {
                    $executives[] = [
                        'name' => $executive['name'] ?? '',
                        'position' => $executive['position'] ?? '',
                        'photo' => $executive['photo'] ?? '',
                    ];
                }
            }
        }
        return ['settingData'=>$settingData,'executives'=>$executives];
    }
}
