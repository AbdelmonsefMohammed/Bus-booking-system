<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bus;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
        ]);

        User::factory(10)->create();
        Bus::factory(10)->create();

        $this->call([
            LocationSeeder::class,
            SeatSeeder::class,
            RouteSeeder::class,
        ]);

        Ride::factory(10)->create();

    }
}
