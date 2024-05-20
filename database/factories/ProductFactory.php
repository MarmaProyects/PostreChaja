<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->numberBetween(1, 100), 
            'section_id' => function () {
                return \App\Models\Section::inRandomOrder()->first()->id;
            },
            'category_id' => function () {
                return \App\Models\Category::inRandomOrder()->first()->id;
            },
        ];
    }
}
