<?php

namespace Database\Factories;

use App\Enums\SubscriberState;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => 'fake-' . $this->faker->unique()->safeEmail(),
            'name' => 'fake-' . $this->faker->name,
            'state' => $this->faker->randomElement(SubscriberState::valueArray()),
        ];
    }
}
