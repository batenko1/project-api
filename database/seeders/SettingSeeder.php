<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $settings = [
            [
                'title' => 'Процент скидки',
                'key' => 'percent_discount',
                'value' => 10,
                'is_not_deleted' => 1
            ]
        ];

        foreach ($settings as $setting) {

            $isSetting = Setting::query()->where('key', $setting['key'])->first();

            if(!$isSetting) {
                Setting::query()->create($setting);
            }

        }

    }
}
