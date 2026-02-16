<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create specific Categories (So they look real)
        $categories = collect(['Technology', 'Music', 'Business', 'Sports', 'Art', 'Health'])
            ->map(function ($name) {
                return EventCategory::create(['name' => $name]);
            });

        // 2. Create an Admin User (So you can login)
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@micmash.com',
            'password' => bcrypt('password'), // password is 'password'
            'is_admin' => true,
        ]);

        // 3. Create 10 Regular Users
        $users = User::factory(10)->create();

        // 4. Create 50 Dummy Events
        // We use 'recycle' to assign these events to the users and categories we just created
        Event::factory(50)
            ->recycle($users)      // Assign to these users
            ->recycle($categories) // Assign to these categories
            ->create();

        echo "Database seeded with 50 events, 10 users, and categories!\n";
    }
}
