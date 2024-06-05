<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class EarningsController extends Controller
{
    public function getEarningsData()
    {
        // Mendapatkan data pendapatan per bulan dalam setahun terakhir
        $earnings = Booking::selectRaw('YEAR(bookings.booking_date) as year, MONTH(bookings.booking_date) as month, SUM(services.price) as total')
            ->join('booking_service', 'bookings.id', '=', 'booking_service.booking_id')
            ->join('services', 'booking_service.service_id', '=', 'services.id')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return response()->json($earnings);
    }
}
