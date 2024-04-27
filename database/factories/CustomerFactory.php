<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'contact_person' => fake()->name,
            'next_payment_date' => fake()->date,
            'is_invoice' => fake()->boolean(),
            'agreed_price' => fake()->numberBetween(0, 1000),
            'impressum' => fake()->paragraph,
            'whatsapp_number' => fake()->phoneNumber,
        ];
    }
}
