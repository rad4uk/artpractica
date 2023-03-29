<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => null,
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'slug' => $this->faker->slug,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function category()
    {
        return $this->faker->randomElement([
            Category::all(),
        ]);
    }
}
