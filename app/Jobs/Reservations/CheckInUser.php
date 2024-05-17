<?php

declare(strict_types=1);

namespace App\Jobs\Reservations;

use App\BookingEngine\Engine;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CheckInUser implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $user,
        public readonly string $booking,
    ) {}

    public function handle(): void
    {
        /** @var Booking $booking */
        $booking = Booking::query()->with(['room'])->findOrFail(
            id: $this->booking,
        );

        $engine = new Engine(
            room: $booking->room,
        );

        $engine->checkIn($booking);
    }
}
