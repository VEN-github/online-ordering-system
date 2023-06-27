<?php

namespace App\Models\Inventory;

use App\Models\Inventory\Traits\InventoryMethod;
use App\Models\Inventory\Traits\InventoryRelationship;
use App\Models\Inventory\Traits\InventoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    use InventoryMethod;
    use InventoryRelationship;
    use InventoryScope;

    protected $fillable = [
        'product_id',
        'variation_id',
        'added_stock',
    ];
}
