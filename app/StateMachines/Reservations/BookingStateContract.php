<?php

declare(strict_types=1);

namespace App\StateMachines\Reservations;

interface BookingStateContract
{
    public function pending();

    public function confirmed();

    public function paid();

    public function checkedIn();

    public function checkedOut();

    public function cancelled();

    public function refunded();

    public function finalized();
}
