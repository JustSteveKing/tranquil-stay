<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\RoomType;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class RoomFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Room::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->company(),
            'label' => Str::title($name),
            'view' => $this->faker->word(),
            'accessible' => $this->faker->boolean() ? 'Wheelchair Accessible' : null,
            'type' => $this->faker->randomElement(
                array: RoomType::cases(),
            ),
            'description' => $this->faker->realText(),
            'sleeps' => $sleeps = $this->faker->numberBetween(
                int1: 1,
                int2: 8,
            ),
            'size' => $size = $sleeps * $this->faker->numberBetween(
                int1: 100,
                int2: 300,
            ),
            'daily_rate' => $daily = $size * 100,
            'weekly_rate' => $daily * 5,
            'floor_id' => Floor::factory(),
        ];
    }
}
