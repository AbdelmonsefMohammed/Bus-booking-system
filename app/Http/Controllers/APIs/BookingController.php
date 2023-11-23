<?php

declare(strict_types=1);

namespace App\Http\Controllers\APIs;

use Exception;
use App\Models\Location;
use App\Services\RideService;
use App\Http\Controllers\Controller;
use Treblle\Tools\Http\Enums\Status;
use App\Http\Requests\BookingRequest;
use Treblle\Tools\Http\Responses\MessageResponse;

final class BookingController extends Controller
{
    public function __construct(
        private RideService $rideService, 
    ) {}  

    public function __invoke(BookingRequest $request)
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
        $ride = $this->rideService->getRideByLocations($startLocation->id, $endLocation->id, $rideDate);

        try {

            $availableSeat = $this->rideService->getAvailableSeats($startLocation, $endLocation, $rideDate, $ride->id)->first();

            $data = [
                'ride_id' => $ride->id,
                'seat_id' => $availableSeat->id,
                'start_location_id' => $startLocation->id,
                'end_location_id' => $endLocation->id,
            ];

            auth()->user()->bookings()->create($data);
            
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
                'message' => "Seat number {$availableSeat->seat_number} booked successfully",
            ],
        );  
    }
}
