<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\RoomType;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $label
 * @property string $view
 * @property null|string $accessible
 * @property RoomType $type
 * @property null|string $description
 * @property int $sleeps
 * @property int $size
 * @property int $daily_rate
 * @property int $weekly_rate
 * @property string $floor_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Floor $floor
 * @property Collection<Booking> $bookings
 * @property Collection<Amenity> $amenities
 */
final class Room extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'label',
        'view',
        'accessible',
        'type',
        'description',
        'sleeps',
        'size',
        'daily_rate',
        'weekly_rate',
        'floor_id',
    ];

    /** @return BelongsTo<Floor> */
    public function floor(): BelongsTo
    {
        return $this->belongsTo(
            related: Floor::class,
            foreignKey: 'floor_id',
        );
    }

    /** @return HasMany<Booking> */
    public function bookings(): HasMany
    {
        return $this->hasMany(
            related: Booking::class,
            foreignKey: 'room_id',
        );
    }

    /** @return BelongsToMany<Amenity> */
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Amenity::class,
            table: 'amenity_room',
        );
    }

    /** @return array<string,string|class-string> */
    protected function casts(): array
    {
        return [
            'type' => RoomType::class,
            'sleeps' => 'integer',
            'size' => 'integer',
            'daily_rate' => 'integer',
            'weekly_rate' => 'integer',
        ];
    }
}
