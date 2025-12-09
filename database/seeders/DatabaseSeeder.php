<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // 1. Create Categories first (Critical!)
    $this->call(EventCategorySeeder::class);

    // 2. Create a specific Admin User (So you can login easily)
    User::factory()->create([
      'name' => 'Admin User',
      'email' => 'admin@example.com',
      'password' => bcrypt('password'), // password is "password"
      'is_admin' => true,
    ]);

    // 3. Create a specific Regular User
    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
      'password' => bcrypt('password'),
      'is_admin' => false,
    ]);

    // 4. Create 10 random users, and give each of them 5 events
    User::factory(10)->create()->each(function ($user) {
      Event::factory(5)->create([
        'user_id' => $user->id, // Assign event to this random user
        // 'category_id' is handled inside the factory automatically picking random ones
      ]);
    });
  }
}
