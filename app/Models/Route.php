<?php

declare( strict_types = 1 );

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function locations() : BelongsToMany
    {
        return $this->belongsToMany(
            related: Location::class,
        )->withPivot('order'); 
    }
}
