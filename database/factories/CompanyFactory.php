<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'industry' => $this->faker->word(),
            'max_vehicles' => $this->faker->numberBetween(1, 30),
            'active' => $this->faker->boolean(),
            'contact_name' => $this->faker->name(),
            'contact_email' => $this->faker->safeEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'country' => $this->faker->country(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'max_drivers' => $this->faker->numberBetween(1, 20),
            'max_routes' => $this->faker->numberBetween(1, 20),
            'has_support_access' => $this->faker->boolean(),
        ];
    }
}
