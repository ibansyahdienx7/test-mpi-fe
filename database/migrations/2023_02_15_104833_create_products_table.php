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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_store');
            $table->integer('id_category');
            $table->integer('id_sub_category');
            $table->string('name');
            $table->integer('stocks');
            $table->string('photo');
            $table->string('second_photo')->nullable();
            $table->string('third_photo')->nullable();
            $table->integer('price');
            $table->integer('discount');
            $table->integer('real_price');
            $table->string('slug');
            $table->integer('status');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
