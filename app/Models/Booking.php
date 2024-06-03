<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'phone_number', 'address', 'booking_date', 'booking_time',
        'barber_id', 'additional_notes', 'payment_method'
    ];

    public function barber()
    {
        return $this->belongsTo(User::class, 'barber_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_service');
    }
}
