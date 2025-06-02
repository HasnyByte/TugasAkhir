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
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->string('quality')->default('Fresh');
            $table->string('origin')->nullable();
            $table->string('status')->default('Available');
            $table->string('unit')->default('kg');
            $table->string('image')->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->timestamps();

            // Indexes untuk performa yang lebih baik
            $table->index('category');
            $table->index('status');
            $table->index('name');
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
