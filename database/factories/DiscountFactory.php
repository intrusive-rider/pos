<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'type' => fake()->randomElement(['perc', 'fixed']),
            'value' => function (array $attr) {
                return $attr['type'] === 'perc'
                    ? round(fake()->numberBetween(1, 90), -1)
                    : fake()->randomDigitNotZero() * 1_000 + fake()->randomElement([10_000, 20_000]);
            },
            'max_value' => function (array $attr) {
                return $attr['type'] === 'perc'
                    ? fake()->randomElement([fake()->randomDigitNotZero() * fake()->randomElement([10_000, 15_000]), null])
                    : null;
            },
            'start_date' => now(),
            'end_date' => now()->addDays(10),
            'active' => true,
        ];
    }
}
