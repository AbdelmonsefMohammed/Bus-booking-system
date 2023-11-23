<?php

declare( strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'seat_number'
    ];

    public function bus() : BelongsTo 
    {
        return $this->belongsTo(
            related: Bus::class,
            foreignKey: 'bus_id',
        ); 
    }
}
