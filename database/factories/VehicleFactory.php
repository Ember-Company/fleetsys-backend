<?php

namespace Database\Factories;

use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
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
            'color' => fake()->colorName(),
            'year' => fake()->year(),
            'license_plate' => fake()->text(6),
            'make' => fake()->word(),
            'model' => fake()->word(),
            'vin' => fake()->randomNumber(),
            'vehicle_type_id' => VehicleType::all()->first()->id
        ];
    }
}
