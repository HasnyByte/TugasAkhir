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
        Schema::create('vegetables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2); // harga per kg
            $table->text('description');
            $table->string('quality');
            $table->string('image');
            $table->string('category');
            $table->string('origin'); // asal daerah
            $table->string('status')->default('Fresh');
            $table->string('unit')->default('kg'); // satuan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vegetables');
    }
};
