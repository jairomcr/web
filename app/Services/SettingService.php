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
        $settingData = Setting::get()->first();

        return $settingData;
    }
}
