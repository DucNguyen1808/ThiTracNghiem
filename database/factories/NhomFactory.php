<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nhom>
 */
class NhomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tennhom' => fake()->numberBetween(1, 100),
            'sosi' => 50,
            'hocky' => 'I',
            'namhoc' => '2021-2022',
        ];
    }
}
