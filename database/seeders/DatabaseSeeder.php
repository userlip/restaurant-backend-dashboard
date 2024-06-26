<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ShieldSeeder::class,
            UserSeeder::class,
            MediaSeeder::class,
            PostSeeder::class,
            CustomerSeeder::class,
            ThemeTemplateOneSeeder::class,
            ThemeTemplateTwoSeeder::class,
        ]);
    }
}
