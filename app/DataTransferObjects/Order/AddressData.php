<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Order;

use Spatie\LaravelData\Data;

class AddressData extends Data
{
    public function __construct(
        public ?string $first_name,
        public ?string $last_name,
        public ?string $address,
        public ?string $city,
        public ?string $country,
        public ?string $state,
        public ?string $postal_code,
        public ?string $phone,
        public bool $is_primary = false
    ) {
    }
}
