<?php 

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = \App\Models\Comment::class;
    
    public function definition(): array
    {
        return [
            'body' => fake()->sentence(),
            'user_id' => \App\Models\User::factory(),
            'recipe_id' => \App\Models\Recipe::factory(),
        ];
    }
}

