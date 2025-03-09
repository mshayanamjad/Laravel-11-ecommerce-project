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
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->double('price', 10, 2);
            $table->double('sale_price', 10, 2)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('is_featured', ['yes', 'no'])->default('no');
            $table->string('sku');
            $table->string('barcode')->nullable();
            $table->enum('track_id', ['yes', 'no'])->default('no');
            $table->integer('qty')->nullable();
            $table->enum('status', ['publish', 'draft'])->default('publish');
            $table->text('short_desc')->nullable();
            $table->string('image')->nullable();
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
