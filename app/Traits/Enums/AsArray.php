<?php

namespace App\Traits\Enums;

trait AsArray
{
    public static function asArray(): array
    {
        $arr = [];

        foreach (self::cases() as $case) {
            $arr[$case->name] = $case->value;
        }

        return $arr;
    }

    public static function asValuesArray(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public static function asNamesArray(): array
    {
        return array_map(fn ($case) => $case->name, self::cases());
    }
}
