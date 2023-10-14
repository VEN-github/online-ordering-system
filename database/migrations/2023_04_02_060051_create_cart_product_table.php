<?php

declare(strict_types=1);

use App\Models\Cart\Cart;
use App\Models\Product\Product;
use App\Models\Variation\Variation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cart::class);
            $table->foreignIdFor(Product::class, 'item_id');
            $table->foreignIdFor(Variation::class)->nullable();

            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('total');

            $table->timestamps();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
