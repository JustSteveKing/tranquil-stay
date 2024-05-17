<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client\Reservations\Rooms;

use App\Http\Controllers\Concerns\HasView;
use App\Models\Room;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class BookingController
{
    use HasView;

    public function __invoke(Request $request, Room $room): View
    {
        $room->load(['bookings']);

        return $this->factory->make(
            view: 'pages.client.reservations.rooms.booking',
            data: [
                'room' => $room,
            ],
        );
    }
}
