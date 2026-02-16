<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// 👇 MAKE SURE THIS SAYS "EventCategoryFactory"
class EventCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
