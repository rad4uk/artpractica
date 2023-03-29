<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => 6,
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'slug' => $this->faker->unique()->url,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
