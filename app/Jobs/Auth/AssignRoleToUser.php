<?php

declare(strict_types=1);

namespace App\Jobs\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class AssignRoleToUser implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly User|Model $user,
        public readonly string $role,
    ) {
    }

    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: function (): void {
                $role = Role::query()->firstOrCreate(['name' => $this->role]);

                $this->user->roles()->save($role);
            },
            attempts: 3,
        );
    }
}
