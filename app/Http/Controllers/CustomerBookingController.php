<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CustomerBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('services', 'barber')
            ->where('full_name', Auth::user()->name);

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $query->whereBetween('booking_date', [$startDate, $endDate]);
        }

        $bookings = $query->get();

        return view('customer.bookings.index', compact('bookings'));
    }


    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->full_name !== Auth::user()->name) {
            return redirect()->route('customer.bookings.index')->with('error', 'Anda tidak memiliki izin untuk mengedit booking ini.');
        }

        $barbers = User::role('barber')->get();
        $services = Service::all();
        return view('customer.bookings.edit', compact('booking', 'barbers', 'services'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->full_name !== Auth::user()->name) {
            return redirect()->route('customer.bookings.index')->with('error', 'Anda tidak memiliki izin untuk mengupdate booking ini.');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'service_ids.*' => 'exists:services,id',
            'barber_id' => 'nullable|exists:users,id',
            'additional_notes' => 'nullable|string',
            'payment_method' => 'required|string|in:cash,credit_card,online_payment',
        ]);

        $data = $request->all();
        $booking->update($data);

        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->full_name !== Auth::user()->name) {
            return redirect()->route('customer.bookings.index')->with('error', 'Anda tidak memiliki izin untuk menghapus booking ini.');
        }

        $booking->delete();
        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }

    public function showReceipt($id)
    {
        $booking = Booking::findOrFail($id);
        return view('customer.bookings.receipt', compact('booking'));
    }

    public function downloadReceipt($id)
    {
        $booking = Booking::find($id);
        $pdf = Pdf::loadView('nota/kwitansi', compact('booking'));
        return $pdf->stream('kwitansi_booking.pdf');
    }

    public function showBooking(Request $request)
    {
        $query = Booking::with('services', 'barber');

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $query->whereBetween('booking_date', [$startDate, $endDate]);
        }

        $bookings = $query->get();

        return view('bookings.index', compact('bookings'));
    }


    public function editBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // Mengambil daftar status yang bisa diubah
        $statusOptions = ['waiting', 'on-progress', 'done'];

        return view('bookings.edit', compact('booking', 'statusOptions'));
    }

    public function updateBooking(Request $request, $id)
    {
        // Menemukan booking berdasarkan ID
        $booking = Booking::findOrFail($id);

        // Validasi input status
        $request->validate([
            'status' => 'required|string|in:waiting,on-progress,done',
        ]);

        // Hanya memperbarui status booking
        $booking->status = $request->input('status');
        $booking->save();

        return redirect()->route('bookingAdmin.index')->with('success', 'Status booking berhasil diperbarui.');
    }



    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('bookingAdmin.index')->with('success', 'Booking berhasil dihapus.');
    }

    public function step1()
    {
        $services = Service::all();
        return view('customer.bookings.step1', compact('services'));
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'service_ids' => 'required|array',
            'service_ids.*' => 'exists:services,id',
        ]);

        session(['service_ids' => $request->service_ids]);
        return redirect()->route('customer.booking.step2');
    }

    public function step2()
    {
        $barbers = User::role('Barber')->get();
        return view('customer.bookings.step2', compact('barbers'));
    }

    public function postStep2(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:users,id',
        ]);

        session(['barber_id' => $request->barber_id]);
        return redirect()->route('customer.booking.step3');
    }

    public function step3(Request $request)
    {
        $availableSlots = [
            '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00',
            '17:00', '18:00', '19:00'
        ];

        $bookings = collect();

        if ($request->has('booking_date')) {
            $bookings = Booking::where('booking_date', $request->booking_date)
                ->where('barber_id', session('barber_id'))
                ->pluck('booking_time');
        }

        return view('customer.bookings.step3', compact('availableSlots', 'bookings'));
    }

    public function postStep3(Request $request)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ]);

        $existingBooking = Booking::where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->where('barber_id', session('barber_id'))
            ->first();

        if ($existingBooking) {
            return redirect()->back()->with('booking_error', 'The selected time is already booked. Please choose a different time.');
        }

        session([
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time
        ]);

        return redirect()->route('customer.booking.confirm');
    }

    // public function confirm()
    // {
    //     $serviceIds = session('service_ids', []);
    //     $services = Service::whereIn('id', $serviceIds)->get();
    //     $barber = User::find(session('barber_id'));
    //     $bookingDate = session('booking_date');
    //     $bookingTime = session('booking_time');

    //     // Calculate total price
    //     $totalPrice = $services->sum('price');

    //     // Calculate discount
    //     $user = Auth::user();
    //     $bookingCount = $user->bookings()->count(); // Corrected method call
    //     $discount = 0;

    //     if ($bookingCount >= 5) {
    //         $discount = $totalPrice * 0.15;
    //         $totalPrice = $totalPrice - $discount;
    //     }

    //     return view('customer.bookings.confirm', compact('services', 'barber', 'bookingDate', 'bookingTime', 'totalPrice', 'discount'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'full_name' => 'required|string|max:255',
    //         'phone_number' => 'required|string|max:15',
    //         'address' => 'nullable|string|max:255',
    //         'additional_notes' => 'nullable|string',
    //         'payment_method' => 'required|string|in:cash,credit_card,online_payment',
    //         'agree_privacy_policy' => 'required|accepted',
    //         'agree_terms_conditions' => 'required|accepted',
    //     ]);

    //     $data = $request->all();
    //     $data['full_name'] = Auth::user()->name;
    //     $data['service_ids'] = session('service_ids');
    //     $data['barber_id'] = session('barber_id');
    //     $data['booking_date'] = session('booking_date');
    //     $data['booking_time'] = session('booking_time');
    //     $data['user_id'] = Auth::id(); // Add user_id

    //     $services = Service::whereIn('id', $data['service_ids'])->get();
    //     $totalPrice = $services->sum('price');

    //     // Calculate discount
    //     $user = Auth::user();
    //     $bookingCount = $user->bookings()->count();
    //     $discount = 0;

    //     if ($bookingCount >= 5) {
    //         $discount = $totalPrice * 0.15;
    //         $totalPrice = $totalPrice - $discount;
    //     }

    //     $data['total_price'] = $totalPrice;

    //     $booking = Booking::create($data);
    //     $booking->services()->sync($data['service_ids']);

    //     return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibuat.');
    // }

    public function confirm()
{
    $serviceIds = session('service_ids', []);
    $services = Service::whereIn('id', $serviceIds)->get();
    $barber = User::find(session('barber_id'));
    $bookingDate = session('booking_date');
    $bookingTime = session('booking_time');

    // Hitung total harga
    $totalPrice = $services->sum('price');

    // Hitung diskon
    $user = Auth::user();
    $bookingCount = $user->bookings()->count();
    $discount = 0;

    // Berikan diskon jika jumlah booking saat ini + 1 adalah kelipatan 5
    if (($bookingCount + 1) % 5 == 0) {
        $discount = $totalPrice * 0.15;
        $totalPrice = $totalPrice - $discount;
    }

    return view('customer.bookings.confirm', compact('services', 'barber', 'bookingDate', 'bookingTime', 'totalPrice', 'discount'));
}

public function store(Request $request)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'address' => 'nullable|string|max:255',
        'additional_notes' => 'nullable|string',
        'payment_method' => 'required|string|in:cash,credit_card,online_payment',
        'agree_privacy_policy' => 'required|accepted',
        'agree_terms_conditions' => 'required|accepted',
    ]);

    // Periksa apakah data yang dibutuhkan ada di sesi
    if (!session()->has(['service_ids', 'barber_id', 'booking_date', 'booking_time'])) {
        return redirect()->route('customer.booking.step1')->with('error', 'Silakan lengkapi informasi booking terlebih dahulu.');
    }

    $data = $request->all();
    $data['full_name'] = Auth::user()->name;
    $data['service_ids'] = session('service_ids');
    $data['barber_id'] = session('barber_id');
    $data['booking_date'] = session('booking_date');
    $data['booking_time'] = session('booking_time');
    $data['user_id'] = Auth::id(); // Menyimpan user_id

    $services = Service::whereIn('id', $data['service_ids'])->get();
    $totalPrice = $services->sum('price');

    // Hitung diskon
    $user = Auth::user();
    $bookingCount = $user->bookings()->count();
    $discount = 0;

    // Berikan diskon jika jumlah booking saat ini + 1 adalah kelipatan 5
    if (($bookingCount + 1) % 5 == 0) {
        $discount = $totalPrice * 0.15;
        $totalPrice = $totalPrice - $discount;
    }

    $data['total_price'] = $totalPrice; // Menyimpan total harga yang sudah dikurangi diskon

    // Simpan booking
    $booking = Booking::create($data);
    $booking->services()->sync($data['service_ids']);

    return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibuat.');
}




    public function checkin($id)
    {
        $booking = Booking::findOrFail($id);

        // Pastikan booking milik user yang sedang login dan statusnya pending
        if ($booking->full_name == Auth::user()->name && $booking->status == 'pending') {
            $booking->status = 'waiting';
            $booking->save();

            return redirect()->route('customer.bookings.index')->with('success', 'Check-In berhasil, status booking sekarang adalah waiting.');
        }

        return redirect()->route('customer.bookings.index')->with('error', 'Anda tidak bisa melakukan check-in pada booking ini.');
    }
}
