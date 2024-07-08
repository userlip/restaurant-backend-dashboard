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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('area_code')
                ->after('email');

            $table->string('city')
                ->after('address');

            $table->string('state')
                ->after('city');

            $table->string('postal_code')
                ->after('state');

            $table->string('country')
                ->after('postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'area_code',
                'city',
                'state',
                'postal_code',
                'country',
            ]);
        });
    }
};
