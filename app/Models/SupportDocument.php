<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $question
 * @property string $answer
 * @property null|array $tags
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 */
final class SupportDocument extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'question',
        'answer',
        'tags',
    ];

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
        ];
    }
}
