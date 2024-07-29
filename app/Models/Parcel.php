<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Parcel extends Model
{
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

    protected $casts = [
        'sending_date' => 'datetime',
        'estimated_delivery_date' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($parcel) {
            if (empty($parcel->tracking_number)) {
                $parcel->tracking_number = static::generateTrackingNumber();
            }
        });
    }

    protected static function generateTrackingNumber()
    {
        return 'TRACK-' . strtoupper(Str::random(10));
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }
}
