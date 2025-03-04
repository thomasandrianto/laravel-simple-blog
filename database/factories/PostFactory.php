<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use App\Enums\PostStatus;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        $status = $this->faker->randomElement(PostStatus::cases()); // Pakai Enum
        
        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(3, true),
            'status' => $status->value,
            'scheduled_at' => $status === PostStatus::Scheduled ? now()->addDays(rand(1, 10)) : null,
            'published_at' => $status === PostStatus::Published ? now()->subDays(rand(1, 10)) : null,
            'image_url' => $this->faker->randomElement([null, 'storage/uploads/sample.jpg']), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
