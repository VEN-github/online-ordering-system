<?php

namespace App\Enums\Traits;

trait ToArray
{
    public static function toArray(): array {
        return array_map(
            fn(self $enum) => $enum->value,
            self::cases()
        );
    }
}