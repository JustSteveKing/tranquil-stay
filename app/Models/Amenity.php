<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $name
 * @property string $label
 * @property null|string $description
 * @property null|string $icon
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Collection<Room> $rooms
 */
final class Amenity extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'label',
        'description',
        'icon',
    ];

    /** @return BelongsToMany<Room> */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Room::class,
            table: 'amenity_room',
        );
    }
}
