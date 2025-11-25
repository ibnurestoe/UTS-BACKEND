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
        // Sesuai aturan validasi: name max 100 char [cite: 39]
        $table->string('name', 100);
        // Price > 0 (gunakan integer atau decimal/double) [cite: 40]
        $table->decimal('price', 15, 2);
        // Stock integer [cite: 41]
        $table->integer('stock');
        $table->timestamps();
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
