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
       Schema::create('delivery_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('inside_dhaka', 8, 2)->default(60.00);
            $table->decimal('outside_dhaka', 8, 2)->default(120.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_settings');
    }
};
