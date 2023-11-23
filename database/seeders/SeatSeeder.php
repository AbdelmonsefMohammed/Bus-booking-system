<?php

declare( strict_types = 1 );

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

final class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buses = Bus::all();

        foreach ($buses as $bus) 
        {
            for ($i=1; $i <= $bus->seats ; $i++) { 
                Seat::create([
                    'bus_id' => $bus->id,
                    'seat_number' => $i,
                ]);
            }
        }
    }
}
