<?php

declare(strict_types=1);

namespace App\BookingEngine;

use App\BookingEngine\Contracts\EngineContract;
use App\Jobs\Reservations\CreateNewBooking;
use App\Models\Booking;
use App\Models\Room;
use Carbon\CarbonInterface;

use function dispatch;
use function number_format;

final readonly class Engine implements EngineContract
{
    public function __construct(
        private Room $room,
    ) {
    }

    public function availableBetween(CarbonInterface $start, CarbonInterface $end): bool
    {
        return (bool) Booking::query()->where(
            column: 'room_id',
            operator: '=',
            value: $this->room->id,
        )->whereBetween(
            column: 'starts_at',
            values: [
                $start,
                $end,
            ],
        )->whereBetween(
            column: 'ends_at',
            values: [
                $start,
                $end,
            ],
        )->count();
    }

    public function book(string $user, CarbonInterface $start, CarbonInterface $end): void
    {
        dispatch(new CreateNewBooking(
            user: $user,
            room: $this->room,
            cost: $this->cost(
                start: $start,
                end: $end,
            ),
            start: $start,
            end: $end,
        ));
    }

    public function cost(CarbonInterface $start, CarbonInterface $end): int|float
    {
        $length = number_format(
            num: $start->diffInDays(
                date: $end,
            ),
        );

        // @todo Expand this to calculate things properly
        // 1 week and 3 days.
        if ($length >= 7) {
            return $this->room->weekly_rate * ($length / 7);
        }

        return $this->room->daily_rate * $length;
    }
}
