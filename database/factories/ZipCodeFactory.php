<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ZipCode>
 */
class ZipCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'zip_code' => $this->faker->randomNumber(5),
            'locality' => $this->faker->streetName(),
            'federal_entity_id' => \App\Models\FederalEntity::inRandomOrder()->first(),
            'municipality_id' => \App\Models\Municipality::inRandomOrder()->first(),
        ];
    }
}
