<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title:en' => $this->faker->words($nb = rand(1, 3), $asText = true),
            'title:fr' => $this->faker->words($nb = rand(1, 3), $asText = true),
            'slug' => $this->faker->slug
        ];
    }
}
