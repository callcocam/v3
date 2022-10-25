<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

use function GuzzleHttp\Promise\all;

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
    public function definition()
    {
        $filePath = storage_path('app/public/images/posts');
        //dd($this->faker->image(null, 640, 480, 'animals'),$this->faker->image($filePath, 640, 400, null, false));
        return [
            'id' => Uuid::uuid4(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            //'cover'=>sprintf("courses/%s", $this->faker->image($filePath, 640, 400, null, false)),
            'category_id'=>Category::all()->random()->id,
            'user_id'=>User::all()->random()->id,
            'updated_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s"),
            'created_at' => now()->subMonths(rand(0,200))->format("Y-m-d H:i:s")
        ];
    }
}
