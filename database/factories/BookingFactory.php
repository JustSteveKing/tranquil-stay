<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

final class BookingFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Booking::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'cost' => $this->faker->numberBetween(
                int1: 1_000,
                int2: 5_000,
            ),
            'room_id' => Room::factory(),
            'user_id' => User::factory(),
            'starts_at' => $start = Carbon::parse(
                time: $this->faker->dateTimeThisMonth(),
            ),
            'ends_at' => $start->addDays(
                value: $this->faker->numberBetween(
                    int1: 1,
                    int2: 7,
                ),
            ),
        ];
    }
}
