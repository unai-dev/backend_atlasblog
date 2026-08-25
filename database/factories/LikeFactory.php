<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Like>
 */
class LikeFactory extends Factory
{
    protected $model = Like::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $postsIDs = Post::pluck("id")->toArray();

        return [
            "post_id" => $this->faker->randomElement($postsIDs)
        ];
    }
}
