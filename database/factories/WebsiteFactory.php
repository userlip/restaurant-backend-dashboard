<?php

namespace Database\Factories;

use App\Enums\WebsiteThemesEnums;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::first()->id,
            'theme' => WebsiteThemesEnums::THEME_1,
            'seo_title' => fake()->sentence,
            'seo_description' => fake()->paragraph,
            'favicon' => fake()->imageUrl,
            'logo' => fake()->imageUrl,
        ];
    }
}
