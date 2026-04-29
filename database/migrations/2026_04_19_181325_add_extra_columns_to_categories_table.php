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
    Schema::table('categories', function (Blueprint $table) {
        if (!Schema::hasColumn('categories', 'slug')) {
            // প্রথমে nullable হিসেবে যোগ করুন, unique দিবেন না
            $table->string('slug')->nullable()->after('name');
        }
        if (!Schema::hasColumn('categories', 'image')) {
            $table->string('image')->nullable()->after('slug');
        }
        if (!Schema::hasColumn('categories', 'status')) {
            $table->integer('status')->default(1)->after('image');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
};
