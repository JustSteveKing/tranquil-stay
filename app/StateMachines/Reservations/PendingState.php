<?php

declare(strict_types=1);

namespace App\StateMachines\Reservations;

final class PendingState extends BaseBookingStateMachine
{
    public function confirmed(): never
    {
        parent::confirmed();
    }
}
