<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'parcel_id',
        'status',
        'location',
        'description',
        'tracking_number',
    ];
    

    /**
     * Get the parcel that owns the tracking update.
     */
    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
    
}
