<?php

declare( strict_types = 1 );

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Location extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = [
        'name',
    ];

    public function routes() : BelongsToMany
    {
        return $this->belongsToMany(
            related: Route::class,
        )->withPivot('order'); 
    }
}
