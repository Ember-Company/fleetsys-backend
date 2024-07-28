<?php

namespace Database\Factories;

use App\Enums\FuelType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fuel>
 */
class FuelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(array_map(fn($case) => $case->name(), FuelType::cases())),
        ];
    }
}
