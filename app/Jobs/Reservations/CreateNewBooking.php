<?php

declare(strict_types=1);

namespace App\Jobs\Reservations;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Room;
use Carbon\CarbonInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CreateNewBooking implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $user,
        public readonly Room $room,
        public readonly int|float $cost,
        public readonly CarbonInterface $start,
        public readonly CarbonInterface $end,
    ) {
    }

    public function handle(): void
    {
        Booking::query()->create([
            'status' => BookingStatus::Pending,
            'cost' => $this->cost,
            'room_id' => $this->room->id,
            'user_id' => $this->user,
            'starts_at' => $this->start,
            'ends_at' => $this->end,
        ]);
    }
}
