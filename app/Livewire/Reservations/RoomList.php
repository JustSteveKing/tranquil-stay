<?php

declare(strict_types=1);

namespace App\Livewire\Reservations;

use App\Models\Room;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

final class RoomList extends Component
{
    #[Computed]
    public function rooms(): Collection
    {
        return Room::query()->with([
            'floor',
            'amenities',
        ])->get();
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.reservations.room-list',
        );
    }
}
