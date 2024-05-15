<?php

declare(strict_types=1);

namespace App\StateMachines\Reservations;

final class CheckedInState extends BaseBookingStateMachine
{
    public function checkedOut(): never
    {
        parent::checkedOut(); // TODO: Change the autogenerated stub
    }
}