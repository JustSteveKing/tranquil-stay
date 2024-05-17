<?php

declare(strict_types=1);

namespace App\StateMachines\Reservations;

use App\Enums\BookingStatus;

final class ConfirmedState extends BaseBookingStateMachine
{
    public function paid(): void
    {
        $this->booking->update(
            attributes: [
                'check_in_code' => $this->booking->generateCheckInCode(),
                'status' => BookingStatus::Paid,
            ],
        );
    }

    public function cancelled(): void
    {
        parent::cancelled();
    }
}
