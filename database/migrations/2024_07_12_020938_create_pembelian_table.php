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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->string('product_code'); // Make sure this matches the type and length in `products`
            $table->enum('category', ['groceries', 'gas', 'cigarettes', 'drinks']);
            $table->string('product_name');
            $table->decimal('product_price', 8, 2);
            $table->timestamps();
        
            $table->foreign('product_code')->references('product_code')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
