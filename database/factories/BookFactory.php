<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class BookFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->sentence(4),
            'user_id' => 1,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => random_int(0, 10)
        ];
    }


}
