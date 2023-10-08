<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('artwork_id')->constrained();
            $table->decimal('price', 10, 2); // Add the price column
            $table->enum('type', ['auction', 'sale']); // Add the type column for auction or sale items
            $table->foreignId('bid_id')->nullable()->constrained(); // Add bid relationship
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
}
