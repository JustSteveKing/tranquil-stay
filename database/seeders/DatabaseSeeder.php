<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->callOnce(
            class: DefaultRolesSeeder::class,
        );

        if ('production' !== app()->environment()) {
            $user = User::factory()->create([
                'name' => 'Steve McDougall',
                'email' => 'juststevemcd@gmail.com',
            ]);

            $user->roles()->save(Role::query()->where('name', 'admin')->first());
        }


    }
}
