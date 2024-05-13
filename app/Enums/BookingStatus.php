<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BookingStatus: string implements HasLabel, HasColor
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Paid = 'paid';
    case CheckedIn = 'checked-in';
    case CheckedOut = 'checked-out';
    case Cancelled = 'cancelled';
    case Refunded = 'refunded';
    case Finalized = 'finalized';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Confirmed => 'Confirmed',
            self::Paid => 'Paid',
            self::CheckedIn => 'Checked In',
            self::CheckedOut => 'Checked Out',
            self::Cancelled => 'Cancelled',
            self::Refunded => 'Refunded',
            self::Finalized => 'Finalized',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'primary',
            self::Confirmed => 'success',
            self::Paid => 'danger',
            self::CheckedIn => 'warning',
            self::CheckedOut => 'info',
            self::Cancelled => 'danger',
            self::Refunded => 'secondary',
            self::Finalized => 'primary',
        };
    }
}
