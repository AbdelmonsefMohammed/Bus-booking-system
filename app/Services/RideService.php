<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ride;
use App\Models\Seat;
use App\Models\Route;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;



final class RideService
{
    public function getAvailableSeats(Location $startLocation, Location $endLocation, string $rideDate, $rideId = null) : Collection
    {
        if(!$rideId)
        {
            $ride = $this->getRideByLocations($startLocation->id, $endLocation->id, $rideDate);
            if (! $ride) {
                return collect();
            }
            $rideId = $ride->id;
        }
        $booked_seats = Booking::join('rides', 'ride_id', 'rides.id')
                ->join('location_route as start_location', function ($join) {
                    $join->on('rides.route_id', 'start_location.route_id')
                        ->on('start_location_id', 'start_location.location_id');
                })->join('location_route as end_location', function ($join) {
                    $join->on('rides.route_id', 'end_location.route_id')
                        ->on('end_location_id', 'end_location.location_id');
                })->where([
                    ['ride_id', '=', $rideId],
                    ['start_location.order', '<', $endLocation->routes->first()->pivot->order],
                    ['end_location.order', '>', $startLocation->routes->first()->pivot->order]
                ])->pluck('seat_id')->toArray();

                return Seat::query()->whereNotIn('id', $booked_seats)->whereHas('bus', function ($query) use ($rideId) {
            $query->whereHas('rides', function ($query) use ($rideId) {
                $query->where('id', $rideId);
            });
        })->get();
    }

    public function getRideByLocations(int $startLocationId, int $endLocationId, string $rideDate) 
    {
        // date + route locations
        $routes = $this->getRouteId($startLocationId, $endLocationId);

        return Ride::whereHas('route', function ($query) use ($routes) {
            $query->whereIn('id', $routes);
        })->where('ride_date', $rideDate)->first();
        
    }

    private function getRouteId(int $startLocationId, int $endLocationId) 
    {
        // return Route::all();
        return Route::whereHas('locations', function ( $query) use ($startLocationId) {
            $query->where('location_id', $startLocationId);
        })->whereHas('locations', function ( $query) use ($startLocationId, $endLocationId) {
            $query->where('location_id', $endLocationId)
                ->where('order', '>', function ( $query) use ($startLocationId) {
                    $query->select('order')
                        ->from('location_route')
                        ->where('location_id', $startLocationId)
                        ->whereColumn('route_id', 'routes.id');
                });
        })
            ->get()
            ->pluck('id')
            ->toArray();
    }
}
