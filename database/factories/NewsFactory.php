<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create('id_ID');
        return [
            'title' => $faker->sentence(8, true),
            'description' => $faker->paragraph(2, true),
            'category' => $faker->sentence(1, true),
            'author' => $faker->name()
        ];
    }
}
