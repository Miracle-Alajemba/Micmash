<?php

namespace Database\Factories;

use App\Models\EventCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        // 1. Define the path where images should go
        $path = storage_path('app/public/eventimages');

        // 2. Create directory if it doesn't exist (Safety check)
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        return [
            'user_id' => User::factory(),
            'category_id' => EventCategory::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'location' => $this->faker->city,
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            'time' => $this->faker->time('H:i'),
            'price' => $this->faker->randomElement([0, rand(1000, 20000)]),
            'status' => 'approved',
            'url' => $this->faker->url(),

            // 👇 THIS DOWNLOADS A REAL IMAGE (640x480)
            // It saves it to your folder and returns just the filename (e.g. 'b5c...jpg')
            'image' => $this->faker->image($path, 640, 480, null, false),
        ];
    }
}/*  */
