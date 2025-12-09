<?php

namespace Database\Factories;

use App\Models\EventCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
  public function definition(): array
  {
    return [
      // Create a User or pick one if we override it
      'user_id' => User::factory(),

      // Pick a random existing category, or create one if none exist
      'category_id' => EventCategory::inRandomOrder()->first()->id ?? EventCategory::factory(),

      'title' => fake()->catchPhrase(), // Catchy titles like "Multi-layered client-server neural-net"
      'description' => fake()->paragraphs(3, true), // Long dummy text
      'location' => fake()->city() . ', ' . fake()->country(),

      // Random date between tomorrow and 4 months from now
      'date' => fake()->dateTimeBetween('+1 day', '+4 months'),
      'time' => fake()->time('H:i'),

      // No image by default (to avoid broken links), or you can use null
      'image' => null,

      // 80% chance of being Approved, 10% Pending, 10% Rejected
      'status' => fake()->randomElement(['approved', 'approved', 'approved', 'approved', 'pending', 'rejected']),
    ];
  }
}/*  */
