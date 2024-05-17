<?php

declare(strict_types=1);

namespace App\Livewire\Reservations;

use App\BookingEngine\Contracts\EngineContract;
use App\BookingEngine\Engine;
use App\Enums\BookingStatus;
use App\Livewire\Concerns\HasUser;
use App\Models\Booking;
use App\Models\Room;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Component;

/**
 * @property-read Form $form
 */
final class BookRoom extends Component implements HasForms
{
    use HasUser;
    use InteractsWithForms;

    public array $data = [];

    public Room $room;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            DateTimePicker::make(name: 'starts_at')->label(label: 'Check In Date')->required(),
            DateTimePicker::make(name: 'ends_at')->label(label: 'Check Out Date')->required(),
        ])->statePath(
            path: 'data',
        );
    }

    public function submit(): void
    {
        // is this room available at this time?
        $engine = new Engine(
            room: $this->room,
        );

        if (! $engine->availableBetween(
            start: Carbon::parse(
                time: $this->form->getState()['starts_at'],
            ),
            end: Carbon::parse(
                time: $this->form->getState()['ends_at'],
            ),
        )) {
            // do something here.
        }

        // Create the booking and redirect to pay.
        $booking = Booking::query()->create(
            attributes: \array_merge(
                [
                    'status' => BookingStatus::Pending,
                    'cost' => $engine->cost(
                        start: Carbon::parse(
                            time: $this->form->getState()['starts_at'],
                        ),
                        end: Carbon::parse(
                            time: $this->form->getState()['ends_at'],
                        ),
                    ),
                    'room_id' => $this->room->id,
                    'user_id' => $this->user()->id,
                ],
                $this->form->getState(),
            )
        );

        $this->redirect(
            url: route('pages:client:checkout', $booking),
        );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.reservations.book-room',
        );
    }
}
