<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->components->info("Fresh Migrate and Database Seeding");

        $this->components->task("Migrating Tables", fn () => Artisan::call('migrate:fresh'));
        $this->line(Artisan::output());

        $this->components->task("Seeding the Database", fn () => Artisan::call('db:seed'));
        $this->line(Artisan::output());
    }
}
