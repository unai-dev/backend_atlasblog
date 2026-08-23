<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoriesIDs = Category::pluck("id")->toArray();

        return [
            "title" => $this->faker->word(),
            "description" => $this->faker->sentence(),
            "category_id" => $this->faker->randomElement($categoriesIDs)
        ];
    }
}
