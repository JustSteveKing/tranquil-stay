<?php

declare(strict_types=1);

namespace App\StateMachines\Reservations;

use App\Exceptions\InvalidStateException;
use App\Models\Booking;

abstract class BaseBookingStateMachine implements BookingStateContract
{
    public function __construct(
        protected Booking $booking,
    ) {}

    public function pending(): never
    {
        throw new InvalidStateException(
            message: 'Cannot transition to the [pending] state.',
        );
    }

    public function confirmed(): never
    {
        throw new InvalidStateException(
            message: 'Cannot transition to the [confirmed] state.',
        );
    }

    public function paid(): never
    {
        throw new InvalidStateException(
            message: 'Cannot transition to the [paid] state.',
        );
    }

    public function checkedIn(): never
    {
        throw new InvalidStateException(
            message: 'Cannot transition to the [checked-in] state.',
        );
    }

    public function checkedOut(): never
    {
        throw new InvalidStateException(
            message: 'Cannot transition to the [checked-out] state.',
        );
    }

    public function cancelled(): never
    {
        throw new InvalidStateException(
            message: 'Cannot transition to the [cancelled] state.',
        );
    }

    public function refunded(): never
    {
        throw new InvalidStateException(
            message: 'Cannot transition to the [refunded] state.',
        );
    }

    public function finalized(): never
    {
        throw new InvalidStateException(
            message: 'Cannot transition to the [finalized] state.',
        );
    }
}
