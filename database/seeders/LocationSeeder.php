<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

final class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['name' => 'Cairo'],
            ['name' => 'Giza'],
            ['name' => 'Alexandria'],
            ['name' => 'Dakahlia'],
            ['name' => 'Red Sea'],
            ['name' => 'Beheira'],
            ['name' => 'Fayoum'],
            ['name' => 'Gharbiya'],
            ['name' => 'Ismailia'],
            ['name' => 'Menofia'],
            ['name' => 'Minya'],
            ['name' => 'Qaliubiya'],
            ['name' => 'New Valley'],
            ['name' => 'Suez'],
            ['name' => 'Aswan'],
            ['name' => 'Assiut'],
            ['name' => 'Beni Suef'],
            ['name' => 'Port Said'],
            ['name' => 'Damietta'],
            ['name' => 'Sharkia'],
            ['name' => 'South Sinai'],
            ['name' => 'Kafr Al sheikh'],
            ['name' => 'Matrouh'],
            ['name' => 'Luxor'],
            ['name' => 'Qena'],
            ['name' => 'North Sinai'],
            ['name' => 'Sohag'],
        ];

        Location::insert($locations);

    }
}
