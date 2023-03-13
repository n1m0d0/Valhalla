<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'identity_card' => $this->faker->unique()->randomNumber(7, true),
            'issued' => $this->faker->randomElement([
                'CH',
                'LP',
                'CB',
                'OR',
                'PT',
                'TJ',
                'SC',
                'BE',
                'PD'
            ]),
            'birthdate' => $this->faker->date(),
            'sex' => $this->faker->randomElement([
                Patient::Male,
                Patient::Female,
            ]),
            'photo_path' => null
        ];
    }
}
