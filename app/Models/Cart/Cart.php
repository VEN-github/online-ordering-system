<?php

declare(strict_types=1);

namespace App\Models\Cart;

use App\Models\User\User;
use Database\Factories\CartFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Cart\Cart
 *
 * @property int $user_id
 * @property-read \App\Models\User\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CartProduct> $products
 */
class Cart extends Model
{
    use HasFactory;

    protected array $fillable = [
        'user_id',
    ];

    protected static function newFactory(): Factory
    {
        return CartFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(CartProduct::class);
    }
}
