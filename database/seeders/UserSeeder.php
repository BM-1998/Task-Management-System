<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'), // Hash the password
            'role' => 'admin', // Role: Admin
        ]);

        // Create Normal User
        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => Hash::make('user'), // Hash the password
            'role' => 'user', // Role: User
        ]);
    }
}
