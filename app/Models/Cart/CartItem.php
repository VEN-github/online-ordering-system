<?php

declare(strict_types=1);

namespace App\Models\Cart;

use App\Models\Product\Product;
use App\Models\Variation\Variation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Cart\CartProduct
 *
 * @property int $cart_id
 * @property int $item_id
 * @property int $variation_id
 * @property int $quantity
 * @property int $total
 * @property-read Cart|null $cart
 * @property-read \App\Models\Product\Product|null $product
 * @property-read \App\Models\Variation\Variation|null $variation
 */
class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'item_id',
        'variation_id',
        'quantity',
        'total',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'item_id', 'id');
    }

    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }
}
