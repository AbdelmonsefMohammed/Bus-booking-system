<?php

declare( strict_types = 1 );

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'route_id',
        'departure_time',
        'ride_date',
    ];

    public function bus() : BelongsTo 
    {
        return $this->belongsTo(
            related: Bus::class,
            foreignKey: 'bus_id',
        ); 
    }

    public function route() : BelongsTo 
    {
        return $this->belongsTo(
            related: Route::class,
            foreignKey: 'route_id',
        ); 
    }
}
