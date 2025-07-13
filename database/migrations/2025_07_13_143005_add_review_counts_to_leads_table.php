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
        Schema::table('leads', function (Blueprint $table) {
            $table->integer('one_star_count')->default(0)->after('status');
            $table->integer('two_star_count')->default(0)->after('one_star_count');
            $table->integer('three_star_count')->default(0)->after('two_star_count');
            $table->integer('four_star_count')->default(0)->after('three_star_count');
            $table->integer('five_star_count')->default(0)->after('four_star_count');
            $table->integer('total_reviews')->default(0)->after('five_star_count');
            $table->decimal('average_rating', 3, 2)->nullable()->after('total_reviews');
            $table->string('google_business_id')->nullable()->after('link');
            $table->timestamp('reviews_last_updated_at')->nullable()->after('average_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'one_star_count',
                'two_star_count',
                'three_star_count',
                'four_star_count',
                'five_star_count',
                'total_reviews',
                'average_rating',
                'google_business_id',
                'reviews_last_updated_at'
            ]);
        });
    }
};
