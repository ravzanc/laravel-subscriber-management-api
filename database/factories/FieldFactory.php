<?php

namespace Database\Factories;

use App\Enums\FieldType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field>
 */
class FieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'fake-' . $this->faker->word,
            'type' => $this->faker->randomElement(FieldType::valueArray()),
        ];
    }
}
