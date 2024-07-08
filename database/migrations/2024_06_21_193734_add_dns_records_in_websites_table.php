<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->json('type_a_dns_record')
                ->nullable()
                ->after('nameserver_transfer');

            $table->json('type_https_dns_record')
                ->nullable()
                ->after('type_a_dns_record');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dropColumn([
                'type_a_dns_record',
                'type_https_dns_record',
            ]);
        });
    }
};
