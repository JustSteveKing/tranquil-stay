<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum RoomType: string implements HasLabel, HasColor, HasDescription
{
    case Single = 'single';
    case Double = 'double';
    case Shared = 'shared';
    case Family = 'family';
    case Apartment = 'apartment';
    case Suite = 'suite';

    public function getLabel(): string
    {
        return match($this) {
            self::Single => 'Single Room',
            self::Double => 'Double Room',
            self::Shared => 'Shared Room',
            self::Family => 'Family Room',
            self::Apartment => 'Apartment',
            self::Suite => 'Suite',
        };
    }

    public function getColor(): string
    {
        return match($this) {
            self::Single => 'primary',
            self::Double => 'secondary',
            self::Shared => 'danger',
            self::Family => 'warning',
            self::Apartment => 'info',
            self::Suite => 'gray',
        };
    }

    public function getDescription(): string
    {
        return match($this) {
            self::Single => 'A single room, maximum of 2 guests',
            self::Double => 'A double room, maximum of 4 guests',
            self::Shared => 'A shared room, maximum of 1 guest',
            self::Family => 'A family room, maximum of 8 guests',
            self::Apartment => 'A apartment room, maximum of 8 guests',
            self::Suite => 'A suite room, maximum of 12 guests',
        };
    }
}
