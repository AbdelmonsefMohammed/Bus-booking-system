<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
final class BusFactory extends Factory
{
    protected $model = Bus::class;

    public function definition(): array
    {
        return [
            'name' => 'bus_' . $this->faker->numberBetween(
                int1: 10_000,
                int2: 99_999,  
            ),
            'seats' => 12,
        ];
    }
}
