<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'email', 'phone_number', 'address', 'booking_date', 'booking_time',
        'service', 'selected_barber', 'additional_notes', 'payment_method'
    ];

    protected $casts = [
        'service' => 'array',  // Add this line
    ];

    public function barber()
    {
        return $this->belongsTo(User::class, 'selected_barber');
    }
}
