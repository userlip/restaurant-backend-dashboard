<?php

namespace App\Console\Commands;

use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AddUuidToWebsites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websites:uuid';

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
        Website::whereNotNull('created_at')
            ->chunkMap(function (Website $website) {
                $website->update([
                    'uuid' => Str::uuid()
                ]);
            });
    }
}
