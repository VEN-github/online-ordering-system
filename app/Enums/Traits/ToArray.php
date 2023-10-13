<?php

declare(strict_types=1);

namespace App\Enums\Traits;

trait ToArray
{
    public static function toArray(): array
    {
        return array_map(
            fn (self $enum) => $enum->value,
            self::cases()
        );
    }
}
