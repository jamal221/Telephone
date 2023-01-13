<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Emd_id'=>fake()->numberBetween(10000000,99999999),
            'mobile'=>fake()->phoneNumber(),
            'name' => fake()->name(),
            'family'=>fake()->lastName(),
            'type'=>fake()->randomElement(['user', 'admin']),
//            'type'=>new Sequence('user','admin'),
            'password' => fake()->numberBetween(1000000,999999),
            'created_at'=>fake()->dateTimeBetween("-1000 day", now()),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
