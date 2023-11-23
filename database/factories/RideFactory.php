<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Ride;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ride>
 */
final class RideFactory extends Factory
{
    protected $model = Ride::class;

    public function definition(): array
    {
        return [
            'bus_id'            => $this->faker->randomElement(Bus::pluck('id')),
            'route_id'          => $this->faker->randomElement(Route::pluck('id')),
            'departure_time'    => $this->faker->time(),
            'ride_date'         => $this->faker->dateTimeBetween('now', '+3 week')->format("Y-m-d"),
        ];
    }
}
