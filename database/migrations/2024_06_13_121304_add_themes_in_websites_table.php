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
            $table->foreignId('theme_id')
                ->nullable()
                ->after('theme')
                ->constrained('themes');

            $table->json('theme_data')
                ->nullable()
                ->after('theme_id');

            $table->dropColumn('theme');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dropConstrainedForeignId('theme_id');
            $table->dropColumn(['theme_data']);

            $table->string('theme')
                ->nullable();
        });
    }
};
