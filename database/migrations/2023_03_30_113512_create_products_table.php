<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('sku')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_active')->default(0);
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->bigInteger('orig_price')->nullable();
            $table->bigInteger('discounted_price')->nullable();
            $table->bigInteger('standard_shipping_price')->nullable();
            $table->bigInteger('express_shipping_price')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('stocks')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
