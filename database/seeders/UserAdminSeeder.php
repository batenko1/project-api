<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->create([
            'name' => "admin",
            'email' => 'batenko4@gmail.com',
            'password' => '121212vb'
        ]);

        $user->assignRole('admin');
    }
}
