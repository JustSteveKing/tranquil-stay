<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class AmenityFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Amenity::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->randomElement(
                array: [
                    'wifi',
                    'sea-view',
                    'air-con',
                    'mini-fridge',
                    'safe',
                ],
            ),
            'label' => Str::title($name),
            'description' => $this->faker->realText(),
            'icon' => null,
        ];
    }
}
