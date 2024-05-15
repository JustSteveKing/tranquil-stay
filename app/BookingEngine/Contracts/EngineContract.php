<?php

declare(strict_types=1);

namespace App\BookingEngine\Contracts;

use App\Models\Room;
use Carbon\CarbonInterface;

/**
 * @property-read Room $room
 */
interface EngineContract
{
    public function availableBetween(CarbonInterface $start, CarbonInterface $end): bool;

    public function book(string $user, CarbonInterface $start, CarbonInterface $end): void;

    public function cost(CarbonInterface $start, CarbonInterface $end): int|float;
}
