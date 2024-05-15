<?php

declare(strict_types=1);

use App\BookingEngine\Engine;
use App\Events\Reservations\BookingWasCreated;
use App\Jobs\Reservations\CreateNewBooking;
use App\Mail\Reservations\BookingIsPending;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

beforeAll(static fn () => Carbon::setTestNow(testNow: '2024-10-12'));

test('we can check the availability of a room', function (): void {
    $room = Room::factory()->create();
    Booking::factory()->for($room)->create([
        'starts_at' => now()->startOfDay(),
        'ends_at' => now()->addDays(2),
    ]);

    expect(
        $room->bookings->count(),
    )->toEqual(1);

    $engine = new Engine(
        room: $room,
    );

    expect(
        $engine->availableBetween(
            start: $start = now()->addDays(4),
            end: $start->addDays(2),
        ),
    )->toBeBool()->toEqual(false)->and(
        $engine->availableBetween(
            start: now()->startOfDay(),
            end: now()->addDays(2),
        ),
    )->toBeBool()->toEqual(true)->and(
        $engine->availableBetween(
            start: now()->addDay(),
            end: now()->addDays(3),
        ),
    )->toBeBool()->toEqual(false);
});

test('it can book a room between certain dates less than one week', function (): void {
    $room = Room::factory()->create([
        'daily_rate' => 1,
    ]);
    $user = User::factory()->create();

    expect(
        Booking::query()->count(),
    )->toEqual(0);

    $engine = new Engine(
        room: $room,
    );

    $engine->book(
        user: $user->id,
        start: now()->addDay(),
        end: now()->addDays(5),
    );

    expect(
        Booking::query()->count(),
    )->toEqual(1)->and(
        Booking::query()->latest()->first(),
    )->cost->toBeInt()->toEqual(4);
});

test('it can book a room between certain dates for more than one week', function (): void {
    $room = Room::factory()->create([
        'weekly_rate' => 10,
    ]);
    $user = User::factory()->create();

    expect(
        Booking::query()->count(),
    )->toEqual(0);

    $engine = new Engine(
        room: $room,
    );

    $engine->book(
        user: $user->id,
        start: now(),
        end: now()->addDays(10),
    );

    expect(
        Booking::query()->count(),
    )->toEqual(1)->and(
        Booking::query()->latest()->first(),
    )->cost->toBeInt()->toEqual(10 * number_format((10 / 7), 1));
});

test('it will dispatch the create new booking job', function (): void {
    Bus::fake();

    $room = Room::factory()->create([
        'weekly_rate' => 10,
    ]);
    $user = User::factory()->create();

    expect(
        Booking::query()->count(),
    )->toEqual(0);

    $engine = new Engine(
        room: $room,
    );

    $engine->book(
        user: $user->id,
        start: $start = now(),
        end: $end = now()->addDays(10),
    );

    Bus::assertDispatched(
        command: CreateNewBooking::class,
        callback: static fn (CreateNewBooking $job) => expect(
            $job->room->id
        )->toEqual($room->id)->and(
            $job->user
        )->toEqual($user->id)->and(
            $job->start
        )->toEqual($start)->and(
            $job->end
        )->toEqual($end)->and(
            $job->cost
        )->toEqual(10 * (10 / 7)),
    );
});

test('an event is fired when the booking is created', function (): void {
    Event::fake(BookingWasCreated::class);

    $room = Room::factory()->create([
        'weekly_rate' => 10,
    ]);
    $user = User::factory()->create();

    expect(
        Booking::query()->count(),
    )->toEqual(0);

    $engine = new Engine(
        room: $room,
    );

    $engine->book(
        user: $user->id,
        start: now(),
        end: now()->addDays(10),
    );

    Event::assertDispatched(
        event: BookingWasCreated::class,
    );
});

test('a email is sent when the booking is created', function (): void {
    Mail::fake();

    $room = Room::factory()->create([
        'weekly_rate' => 10,
    ]);
    $user = User::factory()->create();

    expect(
        Booking::query()->count(),
    )->toEqual(0);

    $engine = new Engine(
        room: $room,
    );

    $engine->book(
        user: $user->id,
        start: now(),
        end: now()->addDays(10),
    );

    expect(
        Booking::query()->count(),
    )->toEqual(1);

    Mail::assertSent(
        mailable: BookingIsPending::class,
    );
});
