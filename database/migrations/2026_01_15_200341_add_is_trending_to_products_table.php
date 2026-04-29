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
    Schema::table('products', function (Blueprint $table) {
        // is_featured এর পরে is_trending যোগ করছি
        $table->boolean('is_trending')->default(0)->after('is_featured');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('is_trending');
    });
}
};
