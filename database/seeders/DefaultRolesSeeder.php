<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

final class DefaultRolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::query()->updateOrCreate([
            'name' => 'guest',
            'label' => 'Hotel Guest',
        ]);
        Role::query()->updateOrCreate([
            'name' => 'support',
            'label' => 'Support Operator',
        ]);
        Role::query()->updateOrCreate([
            'name' => 'staff',
            'label' => 'Hotel Staff',
        ]);
        Role::query()->updateOrCreate([
            'name' => 'admin',
            'label' => 'Hotel Administrator',
        ]);
    }
}
