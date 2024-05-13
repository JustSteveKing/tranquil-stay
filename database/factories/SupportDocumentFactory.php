<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SupportDocument;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class SupportDocumentFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = SupportDocument::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence(),
            'answer' => $this->faker->realText(),
            'tags' => [
                $this->faker->word(),
                $this->faker->word(),
            ]
        ];
    }
}
