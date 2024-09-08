<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $attributes = [
            'materiais perigosos',
            'refrigerado',
            'fragil',
            'carga',
            'transporta liquidos',
            'alta capacidade',
            'pouca emissão',
            'off-road',
            'rapido',
            'resistente'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($attributes),
        ];
    }
}
