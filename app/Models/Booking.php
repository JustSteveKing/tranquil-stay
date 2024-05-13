<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BookingStatus;
use App\Exceptions\InvalidStateException;
use App\StateMachines\Reservations\BaseBookingStateMachine;
use App\StateMachines\Reservations\CancelledState;
use App\StateMachines\Reservations\CheckedInState;
use App\StateMachines\Reservations\CheckedOutState;
use App\StateMachines\Reservations\ConfirmedState;
use App\StateMachines\Reservations\FinalizedState;
use App\StateMachines\Reservations\PaidState;
use App\StateMachines\Reservations\PendingState;
use App\StateMachines\Reservations\RefundedState;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property BookingStatus $status
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
        'status',
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

    public function state(): BaseBookingStateMachine
    {
        return match ($this->status) {
            BookingStatus::Pending => new PendingState(
                booking: $this,
            ),
            BookingStatus::Confirmed => new ConfirmedState(
                booking: $this,
            ),
            BookingStatus::Paid => new PaidState(
                booking: $this,
            ),
            BookingStatus::CheckedIn => new CheckedInState(
                booking: $this,
            ),
            BookingStatus::CheckedOut => new CheckedOutState(
                booking: $this,
            ),
            BookingStatus::Cancelled => new CancelledState(
                booking: $this,
            ),
            BookingStatus::Refunded => new RefundedState(
                booking: $this,
            ),
            BookingStatus::Finalized => new FinalizedState(
                booking: $this,
            ),
        };
    }

    /** @return array<string,string|class-string> */
    protected function casts(): array
    {
        return [
            'cost' => 'integer',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'status' => BookingStatus::class,
        ];
    }
}
