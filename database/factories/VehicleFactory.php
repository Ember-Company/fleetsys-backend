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
        $licensePlate = strtoupper($this->faker->bothify('??-####'));

        return [
            'name' => $this->faker->word(),
            'color' => $this->faker->safeColorName(),
            'year' => $this->faker->year($max = 'now'),
            'license_plate' => $licensePlate,
            'make' => $this->faker->company(),
            'model' => $this->faker->word(),
            'vin' => $this->faker->uuid(),
            'vehicle_type_id' => \App\Models\VehicleType::inRandomOrder()->first()->id
        ];
    }
}
