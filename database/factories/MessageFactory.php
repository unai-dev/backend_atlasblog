<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    protected $model = Message::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $postsIDs = Post::pluck("id")->toArray();

        return [
            "content" => $this->faker->sentence(),
            "post_id" => $this->faker->randomElement($postsIDs)
        ];
    }
}
