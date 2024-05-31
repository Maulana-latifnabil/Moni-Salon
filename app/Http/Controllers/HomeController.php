<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Booking;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::today();
        $services = Service::all(); // Mengambil semua layanan

        if (Auth::check()) {
            $user = Auth::user();

            // Kondisi untuk admin
            if ($user->hasRole('Admin')) {
                // Mengambil semua booking berdasarkan tanggal hari ini dan mengurutkannya berdasarkan waktu booking
                $bookingsToday = Booking::whereDate('booking_date', $today)
                    ->orderBy('booking_time', 'asc')
                    ->get();
            }
            // Kondisi untuk barber
            elseif ($user->hasRole('Barber')) {
                // Mengambil booking berdasarkan tanggal hari ini dan barber yang login
                $bookingsToday = Booking::where('barber_id', $user->id)
                    ->whereDate('booking_date', $today)
                    ->orderBy('booking_time', 'asc')
                    ->get();
            }
            // Jika user tidak memiliki peran yang sesuai
            else {
                return view('home', compact('services'));
            }

            return view('home', compact('services', 'bookingsToday'));
        } else {
            // Jika user tidak login
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Sesuaikan dengan halaman yang ingin Anda arahkan setelah logout
    }
}
