<?php

namespace App\Enum;

enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case DRIVER = 'driver';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::USER => 'Uživatel',
            self::DRIVER => 'Řidič',
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
