<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'phone_number', 'address', 'booking_date', 'booking_time',
        'barber_id', 'additional_notes', 'payment_method', 'user_id', 'status'
    ];

    public function barber()
    {
        return $this->belongsTo(User::class, 'barber_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_service');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $overlapBooking = Booking::where('barber_id', $model->barber_id)
                ->where('booking_date', $model->booking_date)
                ->where('booking_time', $model->booking_time)
                ->exists();

            // if ($overlapBooking) {
            //     throw new \Exception('Waktu ini sudah terpilih untuk barber yang anda pilih');
            // }
        });
    }

    public function calculateTotalWithDiscount()
    {
        $totalPrice = $this->services->sum('price');
        $bookingCount = $this->user->bookings()->count();

        if ($bookingCount >= 5) {
            $totalPrice = $totalPrice * 0.85; // Apply 15% discount
        }

        return $totalPrice;
    }
}
