<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import the User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Option 1: Create a specific admin/test user first
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Hash the password
            'is_admin' => true, // Make this user an admin if you have the column
        ]);

        // Option 2: Create a regular test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'), // Hash the password
            'is_admin' => false, // Set to false if you have the column
        ]);


        // Option 3: Create many random regular users
        User::factory()->count(50)->create(); // Creates 50 random users

        // Option 4: Create some random admins (if you have the 'is_admin' column and 'admin' state)
        // User::factory()->count(5)->admin()->create(); // Creates 5 random admin users

        // Option 5: Mix and match
        // User::factory()->count(100)->create(); // 100 regular users
        // User::factory()->count(10)->admin()->create(); // 10 admin users
    }
}
