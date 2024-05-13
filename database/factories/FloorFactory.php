<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Building;
use App\Models\Floor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class FloorFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Floor::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->buildingNumber(),
            'label' => $this->faker->company(),
            'description' => $this->faker->realText(),
            'building_id' => Building::factory(),
        ];
    }
}
