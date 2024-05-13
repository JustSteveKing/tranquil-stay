<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Role;
use App\Models\Room;
use App\Models\SupportDocument;
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

            SupportDocument::factory()->count(10)->create();

            $building = Building::factory()->create();

            Floor::factory()->for($building)->count(4)->create()->each(
                callback: function (Floor $floor): void {
                    Room::factory()->for($floor)->count(20)->create()->each(
                        callback: function (Room $room): void {
                            Booking::factory()->for($room)->count(2)->create();
                        },
                    );
                },
            );
        }
    }
}
