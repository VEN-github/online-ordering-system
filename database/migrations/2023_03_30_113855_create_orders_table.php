<?php

declare(strict_types=1);

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\ShippingMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('company')->nullable();
            $table->longText('address')->nullable();
            $table->longText('unit')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->enum('payment_method', PaymentMethod::toArray());
            $table->enum('payment_status', PaymentStatus::toArray());
            $table->enum('status', OrderStatus::toArray());
            $table->enum('shipping_method', ShippingMethod::toArray());
            $table->bigInteger('shipping_price')->nullable();
            $table->bigInteger('total_price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
