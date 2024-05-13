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
 * @property string $name
 * @property string $label
 * @property null|string $description
 * @property string $building_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Building $building
 * @property Collection<Room> $rooms
 */
final class Floor extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'label',
        'description',
        'building_id',
    ];

    /** @return BelongsTo<Building> */
    public function building(): BelongsTo
    {
        return $this->belongsTo(
            related: Building::class,
            foreignKey: 'building_id',
        );
    }

    /** @return HasMany<Room> */
    public function rooms(): HasMany
    {
        return $this->hasMany(
            related: Room::class,
            foreignKey: 'floor_id',
        );
    }
}
