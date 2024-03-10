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
            ],
            [
                'title' => 'Ключ эквайринга',
                'key' => 'payment_key',
                'value' => 'ca7782e8-161d-4b99-b5f5-d82795500da5',
                'is_not_deleted' => 1
            ],
            [
                'title' => 'Заголовок сайта',
                'key' => 'title_site',
                'value' => 'Название сайта',
                'is_not_deleted' => 1
            ],
            [
                'title' => 'Логотоп',
                'key' => 'logo',
                'value' => '',
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
