<?php

namespace App\Enum;

enum VehicleManufacturer: string
{
    case SKODA = 'Škoda';
    case VW = 'VW';
    case VOLKSWAGEN = 'Volkswagen';
    case DAF = 'DAF';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getLogo(string $manufacturer, string $theme = 'light'): string
    {
        if ($theme === 'light') {
            return match ($manufacturer) {
                self::SKODA->value => '/img/fleet/skoda.png',
                self::VOLKSWAGEN->value, self::VW->value => '/img/fleet/VW.png',
                self::DAF->value => '/img/fleet/DAF.png',
            };
        } else {
            return match ($manufacturer) {
                self::SKODA->value => '/img/fleet/skoda_white.png',
                self::VOLKSWAGEN->value, self::VW->value => '/img/fleet/VW_white.png',
                self::DAF->value => '/img/fleet/DAF.png',
            };
        }
    }
}
