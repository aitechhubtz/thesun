<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'aitechhubtz@gmail.com'],
            [
                'name' => 'Site Admin',
                'password' => Hash::make('Rubeni@2003'),
                'role' => 'admin',
            ]
        );
    }
}
