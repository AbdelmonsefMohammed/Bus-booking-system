<?php

declare( strict_types = 1 );

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'seats'
    ];

    public function rides() : HasMany 
    {
        return $this->hasMany(
            related: Ride::class,
            foreignKey: 'bus_id',
        ); 
    }
}
