<?php

declare( strict_types = 1);

namespace App\Http\Resources;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Seat $resource
*/
final class SeatResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->resource->id,
            'seat_number'   => $this->resource->seat_number,
        ];
    }
}
