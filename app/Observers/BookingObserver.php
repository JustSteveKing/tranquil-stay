<?php

declare(strict_types=1);

namespace App\Observers;

use App\Events\Reservations\BookingWasCreated;
use App\Models\Booking;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class BookingObserver
{
    public function __construct(
        private Dispatcher $dispatcher,
    ) {
    }

    public function created(Booking $booking): void
    {
        $this->dispatcher->dispatch(
            event: new BookingWasCreated(
                booking: $booking,
            ),
        );
    }
}
