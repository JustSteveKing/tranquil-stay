<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property int $guests
 * @property int $cost
 * @property string $room_id
 * @property string $user_id
 * @property CarbonInterface $starts_at
 * @property CarbonInterface $ends_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Room $room
 * @property User $user
 * @property Collection<Guest> $guests
 */
final class Booking extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'cost',
        'room_id',
        'user_id',
        'starts_at',
        'ends_at',
    ];

    /** @return BelongsTo<Room> */
    public function room(): BelongsTo
    {
        return $this->belongsTo(
            related: Room::class,
            foreignKey: 'room_id',
        );
    }

    /** @return BelongsTo<User> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany<Guest> */
    public function guests(): HasMany
    {
        return $this->hasMany(
            related: Guest::class,
            foreignKey: 'booking_id',
        );
    }

    /** @return array<string,string|class-string> */
    protected function casts(): array
    {
        return [
            'cost' => 'integer',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }
}
