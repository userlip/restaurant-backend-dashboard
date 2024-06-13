<?php

namespace App\Console\Commands;

use Database\Seeders\ThemeTemplateOneSeeder;
use Database\Seeders\ThemeTemplateTwoSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class add_theme_templates_command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('db:seed', [
            '--class' => ThemeTemplateOneSeeder::class
        ]);

        Artisan::call('db:seed', [
            '--class' => ThemeTemplateTwoSeeder::class
        ]);
    }
}
