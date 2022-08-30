<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FederalEntity>
 */
class FederalEntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [            
            'key' => $this->faker->randomNumber(2),
            'name' => $this->faker->country(),
            'code' => $this->faker->buildingNumber(),
        ];
    }
}
