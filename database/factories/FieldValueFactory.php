<?php

namespace Database\Factories;

use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FieldValue>
 */
class FieldValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subscriber_id' => Subscriber::factory(),
            'field_id' => Field::factory(),
            'value' => 'fake-' . $this->faker->words(2, true),
        ];
    }
}
