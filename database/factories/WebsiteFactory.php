<?php

namespace Database\Factories;

use App\Enums\WebsiteThemesEnums;
use App\Models\Customer;
use Awcodes\Curator\Models\Media;
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
            'domain' => fake()->domainName,
            'theme' => rand(0, 1) ? WebsiteThemesEnums::THEME_1 : WebsiteThemesEnums::THEME_2,
            'seo_title' => fake()->sentence,
            'seo_description' => fake()->sentence,
            'favicon' => fake()->imageUrl,
            'logo' => fake()->imageUrl,
        ];
    }
}
