<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Settlement>
 */
class SettlementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'key' => $this->faker->randomNumber(4),
            'name' => $this->faker->streetName(),            
            'zone_type' => $this->faker->streetSuffix(),
            'zip_code_id' => \App\Models\ZipCode::inRandomOrder()->first(),
            'settlement_type_id' => \App\Models\SettlementType::inRandomOrder()->first(),
        ];
    }
}
