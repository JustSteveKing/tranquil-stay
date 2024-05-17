<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Reservations\Bookings;

use App\Enums\BookingStatus;
use App\Jobs\Reservations\CheckInUser;
use App\Models\Booking;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class CheckInController
{
    public function __construct(
        private Dispatcher $bus,
    ) {
    }

    public function __invoke(Request $request, Booking $booking): JsonResponse
    {
        if (BookingStatus::Paid !== $booking->status) {
            throw new UnauthorizedException(
                message: 'You are not able to check-in right now, please seek assistance.',
            );
        }

        if ($booking->check_in_code !== $request->string('code')->toString()) {
            throw new UnauthorizedException(
                message: 'You are not able to check-in with that code.',
            );
        }

        $this->bus->dispatch(new CheckInUser(
            user: Auth::id(),
            booking: $booking->id,
        ));

        return new JsonResponse(
            data: [
                'message' => 'Thank you for checking in.',
            ],
            status: Status::ACCEPTED->value,
        );

        // move the bookings state to checked in.
    }
}
