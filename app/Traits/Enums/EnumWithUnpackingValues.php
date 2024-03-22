<?php

namespace App\Traits\Enums;

trait EnumWithUnpackingValues
{
    public static function unpackValues(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
