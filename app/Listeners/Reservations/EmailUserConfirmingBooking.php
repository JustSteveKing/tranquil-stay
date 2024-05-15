<?php

declare(strict_types=1);

namespace App\Listeners\Reservations;

use App\Events\Reservations\BookingWasCreated;
use App\Mail\Reservations\BookingIsPending;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

final readonly class EmailUserConfirmingBooking implements ShouldQueue
{
    public function handle(BookingWasCreated $event): void
    {
        Mail::to([$event->booking->user->email])->send(
            new BookingIsPending(),
        );
    }
}
