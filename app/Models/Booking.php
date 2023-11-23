<?php

declare( strict_types = 1 );

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ride_id',
        'seat_id',
        'start_location_id',
        'end_location_id',
    ];

    public function user() : BelongsTo 
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        ); 
    }

    public function ride() : BelongsTo 
    {
        return $this->belongsTo(
            related: Ride::class,
            foreignKey: 'ride_id',
        ); 
    }

    public function seat() : BelongsTo 
    {
        return $this->belongsTo(
            related: Seat::class,
            foreignKey: 'seat_id',
        ); 
    }

    public function StartLocation() : BelongsTo 
    {
        return $this->belongsTo(
            related: Location::class,
            foreignKey: 'start_location_id',
        ); 
    }

    public function EndLocation() : BelongsTo 
    {
        return $this->belongsTo(
            related: Location::class,
            foreignKey: 'end_location_id',
        ); 
    }
}
