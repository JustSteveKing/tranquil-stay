<?php

declare(strict_types=1);

namespace App\Enums;

enum RoomType: string
{
    case Single = 'single';
    case Double = 'double';
    case Shared = 'shared';
    case Family = 'family';
    case Apartment = 'apartment';
    case Suite = 'suite';
}
