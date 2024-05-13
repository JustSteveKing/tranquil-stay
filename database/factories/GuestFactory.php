<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class GuestFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Guest::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'adult' => $this->faker->boolean(),
            'booking_id' => Booking::factory(),
            'user_id' => null,
        ];
    }
}
