<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'customer_id',
        'receiver_id',
        'carrier',
        'sending_date',
        'weight',
        'status',
        'estimated_delivery_date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($parcel) {
            if (empty($parcel->tracking_number)) {
                $parcel->tracking_number = 'TRK-' . strtoupper(Str::random(10)); // Generate a unique tracking number
            }
        });
    }
}
