<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = \App\Models\Rating::class;

    public function definition(): array
    {
        return [
            'score' => fake()->numberBetween(1, 5),
            'user_id' => \App\Models\User::factory(),
            'recipe_id' => \App\Models\Recipe::factory(),
        ];
    }
}
