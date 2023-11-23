<?php

declare( strict_types = 1 );

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

final class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined trips
        
        $route1 = Route::create([
                        'name' => 'Cairo to Asyut',
                    ]);

        $route1->locations()->attach([1 => ['order' => 1], 7 => ['order' => 2], 11 => ['order' => 3], 16 => ['order' => 4]]);

        $route2 = Route::create([
                        'name' => 'Cairo to Matrouh',
                    ]);
                    
        $route2->locations()->attach([1 => ['order' => 1], 3 => ['order' => 2], 23 => ['order' => 3]]);
    }
}
