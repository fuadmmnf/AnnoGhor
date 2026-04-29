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
        Schema::create('banners', function (Blueprint $table) {
    $table->id();
    $table->string('image'); // ছবির নাম বা পাথ
    $table->string('type');  // 'slider' নাকি 'static_side' তা চেনার জন্য
    $table->unsignedBigInteger('category_id')->nullable(); // যদি ক্যাটাগরিতে লিঙ্ক করাতে চান
    $table->string('link')->nullable(); // যদি কোনো কাস্টম লিঙ্কে পাঠাতে চান
    $table->boolean('status')->default(1); // ১ মানে একটিভ, ০ মানে ইন-একটিভ
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
