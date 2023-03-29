<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = Image::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pages = $this->pages();
//        $image = $this->faker->image($filePath,400, 300, null, false);
        $imageUrl = $this->faker->imageUrl(400,300);
        return [
//            'object_id' => $pages::factory(),
            'path' => $imageUrl,
            'alt' => $this->faker->title,
//            'type' => $pages,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    public function pages()
    {
        return $this->faker->randomElement([
            Page::class,
        ]);
    }
}
