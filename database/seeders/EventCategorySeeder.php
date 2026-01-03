<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventCategory;

class EventCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Technology',
            'Music & Arts',
            'Sports & Fitness',
            'Business & Career',
            'Food & Drink',
            'Charity & Causes',
            'Community & Culture',
            'Family & Education',
            'conferences'
        ];

        foreach ($categories as $category) {
            EventCategory::create(['name' => $category]);
        }
    }
}
