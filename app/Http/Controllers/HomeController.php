<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;

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
        $services = Service::all(); // Mengambil semua layanan
        return view('home', compact('services'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Sesuaikan dengan halaman yang ingin Anda arahkan setelah logout
    }
}
