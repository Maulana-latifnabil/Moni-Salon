<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        // Decode JSON service for each booking (not necessary if using $casts in model)
        foreach ($bookings as $booking) {
            $booking->service = json_decode($booking->service, true);
        }

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $barbers = User::role('barber')->get();
        $services = Service::all(); // Ambil semua layanan
        return view('bookings.create', compact('barbers', 'services'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:bookings',
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'service' => 'required|array',
            'selected_barber' => 'nullable|exists:users,id',
            'additional_notes' => 'nullable|string',
            'payment_method' => 'required|string|in:cash,credit_card,online_payment',
            'agree_privacy_policy' => 'required|accepted',
            'agree_terms_conditions' => 'required|accepted',
        ]);

        $data = $request->all();
        $data['service'] = json_encode($request->service);

        Booking::create($data);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $barbers = User::role('barber')->get();
        $services = Service::all(); // Ambil semua layanan
        $booking->service = json_decode($booking->service, true);
        return view('bookings.edit', compact('booking', 'barbers', 'services'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:bookings,email,' . $id,
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'service' => 'required|array',
            'selected_barber' => 'nullable|exists:users,id',
            'additional_notes' => 'nullable|string',
            'payment_method' => 'required|string|in:cash,credit_card,online_payment',
        ]);

        $data = $request->all();
        $data['service'] = json_encode($request->service);

        $booking->update($data);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
