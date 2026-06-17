<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'antoine62217a@gmail.com'],
            [
                'name' => 'Antoine',
                'password' => Hash::make(env('ADMIN_PASSWORD')),
            ]
        );
    }
}
