<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Tag;
use App\Models\Meal;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Category::factory()->count(5)->create();
        Ingredient::factory()->count(10)->create();
        Tag::factory()->count(5)->create();
        Meal::factory()->count(20)->create();

        
        $tags = Tag::all();
        $ingredients = Ingredient::all();

        Meal::all()->each(function ($meal) use ($tags, $ingredients) { 
            $meal->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );

            $meal->ingredients()->attach(
                $ingredients->random(rand(1, 3))->pluck('id')->toArray()
            );

        });

        
    }
}
