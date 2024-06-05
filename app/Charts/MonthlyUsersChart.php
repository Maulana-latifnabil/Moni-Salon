<?php

namespace App\Charts;

use App\Models\Booking;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $year = date('Y');
        $monthlyEarnings = [];

        // Initialize earnings for each month
        for ($month = 1; $month <= 12; $month++) {
            $monthlyEarnings[$month] = 0;
        }

        // Fetch bookings for the current year
        $bookings = Booking::whereYear('booking_date', $year)->get();

        foreach ($bookings as $booking) {
            $bookingMonth = Carbon::parse($booking->booking_date)->month;
            $monthlyEarnings[$bookingMonth] += $booking->services->sum('price');
        }

        $earningsData = array_values($monthlyEarnings);
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        return $this->chart->lineChart()
            ->setTitle('Monitor Pendapatan')
            ->setSubtitle('Pendapatan Bulanan')
            ->addData('Pendapatan', $earningsData)
            ->setHeight('400')
            ->setXAxis($months);
    }
}
