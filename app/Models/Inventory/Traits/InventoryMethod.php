<?php

namespace App\Models\Inventory\Traits;

use App\Models\Inventory\Inventory;

trait InventoryMethod
{
    public function loadMissingRelationships(): Inventory
    {
        return static::loadMissing(get_class_methods(InventoryRelationship::class));
    }
}
