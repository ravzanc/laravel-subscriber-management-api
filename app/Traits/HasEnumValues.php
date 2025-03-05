<?php

namespace App\Traits;

trait HasEnumValues
{
    public static function valueArray(): array
    {
        return array_map(function(self $case) {
            return $case->value;
        }, self::cases());
    }
}
