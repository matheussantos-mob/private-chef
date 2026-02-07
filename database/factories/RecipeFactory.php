<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;


class RecipeFactory extends Factory
{
    protected $model = \App\Models\Recipe::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'ingredients' => ['Ovo', 'Farinha', 'Leite', 'Açúcar'],
            'steps' => fake()->text(),
            'user_id' => \App\Models\User::factory(),
        ];
    }

}