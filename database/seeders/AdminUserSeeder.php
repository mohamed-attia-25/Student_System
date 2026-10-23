<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sis.com'],
            [
                'name' => 'AdminSystem',
                'password' => Hash::make("admin123"),
                'role' => 'admin',
                'is_active' => true,
            ],
        );
    }
}
