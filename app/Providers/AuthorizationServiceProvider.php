<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use DirectoryTree\Authorization\Authorization;
use Illuminate\Support\ServiceProvider;

final class AuthorizationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Authorization::useUserModel(User::class);
        Authorization::useRoleModel(Role::class);
        Authorization::usePermissionModel(Permission::class);
    }
}
