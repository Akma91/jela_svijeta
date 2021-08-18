<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title:en' => $this->faker->word,
            'title:fr' => $this->faker->word,
            'description:en' => $this->faker->sentence($nbWords = 10),
            'description:fr' => $this->faker->sentence($nbWords = 10),
            'category_id' => rand(0, 3) ? Category::factory() : null,
            'updated_at' => $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now'),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-8 years', $endDate = '-5 years'),
            'deleted_at' => rand(0, 4) ? null : $this->faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now')
        ];
    }
}
