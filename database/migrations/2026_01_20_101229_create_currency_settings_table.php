<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currency_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('currency_mode', ['single', 'double'])->default('single');
            $table->string('primary_currency', 10)->default('USD');
            $table->string('secondary_currency', 10)->nullable();
            $table->decimal('conversion_rate', 10, 4)->nullable()->comment('Primary to Secondary conversion rate');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency_settings');
    }
};