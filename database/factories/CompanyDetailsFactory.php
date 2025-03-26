<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyDetails>
 */
class CompanyDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'application_details' => $this->faker->paragraphs(3, true),
            'company_address' => $this->faker->paragraphs(3, true),
            'company_bank_details' => $this->faker->paragraphs(3, true),
        ];
    }
}
