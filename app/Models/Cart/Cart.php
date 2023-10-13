<?php

declare(strict_types=1);

namespace App\Models\Cart;

use App\Models\Cart\Traits\CartMethod;
use App\Models\Cart\Traits\CartRelationship;
use App\Models\Cart\Traits\CartScope;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use CartMethod;
    use CartRelationship;
    use CartScope;
}
