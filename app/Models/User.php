<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\UserObserver;
use Carbon\CarbonInterface;
use DirectoryTree\Authorization\Traits\Authorizable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Paddle\Billable;
use Laravel\Paddle\Transaction;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property null|string $remember_token
 * @property null|CarbonInterface $email_verified_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property null|CarbonInterface $deleted_at
 * @property Customer $customer
 * @property Collection<Transaction> $transactions
 * @property Collection<Booking> $bookings
 * @property Collection<Guest> $guest
 */
#[ObservedBy(classes: UserObserver::class)]
final class User extends Authenticatable implements FilamentUser
{
    use Authorizable;
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use HasUuids;
    use Notifiable;
    use SoftDeletes;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /** @var array<int,string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @return HasMany<Booking> */
    public function bookings(): HasMany
    {
        return $this->hasMany(
            related: Booking::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany<Guest> */
    public function guest(): HasMany
    {
        return $this->hasMany(
            related: Guest::class,
            foreignKey: 'user_id',
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ('admin' === $panel->getId()) {
            return $this->hasRole(role: 'admin');
        }

        return true;
    }

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
