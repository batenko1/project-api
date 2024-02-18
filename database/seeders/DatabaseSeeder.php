<?php

namespace Database\Seeders;


use App\Models\Entity;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Entity::query()->truncate();
        Entity::factory(30)->create();
        Entity::factory(50)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
