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
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_active')->default(0);
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('discounted_price')->nullable();
            $table->boolean('has_variation')->default(0);
            // $table->string('highlighted_image')->nullable();
            $table->bigInteger('standard_shipping_price')->nullable();
            $table->bigInteger('express_shipping_price')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
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