<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@agency.com',
            'phone' => '01900000000',
            'address' => 'Dhaka, Bangladesh',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
