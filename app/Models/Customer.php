<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Paddle\Customer as PaddleCustomer;

final class Customer extends PaddleCustomer
{
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'billable_id',
        'billable_type',
        'paddle_id',
        'name',
        'email',
        'trial_ends_at',
    ];

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'trial_ends_at' => 'datetime',
        ];
    }
}
