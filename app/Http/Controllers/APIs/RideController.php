<?php

declare(strict_types=1);

namespace App\Http\Controllers\APIs;

use App\Models\Location;
use App\Services\RideService;
use App\Http\Controllers\Controller;
use App\Http\Resources\SeatResource;
use Treblle\Tools\Http\Enums\Status;
use App\Http\Requests\SearchRideRequest;
use Illuminate\Contracts\Support\Responsable;
use Treblle\Tools\Http\Responses\MessageResponse;

final class RideController extends Controller
{

    public function __construct(
        private RideService $service, 
    ) {}  
    public function __invoke(SearchRideRequest $request) : Responsable
    {
        $startLocation = Location::where('name', $request->start_location)->with('routes')->first();
        $endLocation = Location::where('name', $request->end_location)->with('routes')->first();
        $rideDate = $request->date;

        if (! $startLocation) {
            $errors['start_location'] = 'The location with the given name does not exist.';
        }
        if (! $endLocation) {
            $errors['end_location'] = 'The location with the given name does not exist.';
        }

        if (isset($errors)) 
        {
            return new MessageResponse(
                data: [
                    'errors' => $errors,
                ],
                status: Status::UNPROCESSABLE_CONTENT,
            );  
        }
        
        try {

            $seats = $this->service->getAvailableSeats($startLocation, $endLocation, $rideDate);
            
        } catch (Exception $exception) {

            $errors['seats'] = 'No available seats for this ride.';

            return new MessageResponse(
                data: [
                    'errors' => $errors,
                ],
                status: Status::UNPROCESSABLE_CONTENT,
            );  
        }

        return new MessageResponse(
            data: [
                'seats' => SeatResource::collection(
                    resource: $seats,
                ),
            ],
        );  
    }
}
