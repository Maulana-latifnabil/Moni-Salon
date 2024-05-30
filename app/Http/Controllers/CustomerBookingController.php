<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('service', 'barber')
            ->where('full_name', Auth::user()->name)
            ->get();

        return view('customer.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $barbers = User::role('barber')->get();
        $services = Service::all();
        return view('customer.bookings.create', compact('barbers', 'services'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15',
                'address' => 'nullable|string|max:255',
                'booking_date' => 'required|date',
                'booking_time' => 'required|date_format:H:i',
                'service_id' => 'required|exists:services,id',
                'barber_id' => 'required|exists:users,id',
                'additional_notes' => 'nullable|string',
                'payment_method' => 'required|string|in:cash,credit_card,online_payment',
                'agree_privacy_policy' => 'required|accepted',
                'agree_terms_conditions' => 'required|accepted',
            ]);

            $data = $request->all();
            $data['full_name'] = Auth::user()->name;

            $booking = Booking::create($data);

            return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibuat.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('customer.bookings.create')->with('error', 'Booking gagal dibuat.');
        }
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
        try {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15',
                'address' => 'nullable|string|max:255',
                'booking_date' => 'required|date',
                'booking_time' => 'required|date_format:H:i',
                'service_id' => 'required',
                'selected_barber' => 'nullable|exists:users,id',
                'additional_notes' => 'nullable|string',
                'payment_method' => 'required|string|in:cash,credit_card,online_payment',
            ]);
            $data = $request->all();

            $booking->update($data);

            return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil diperbarui.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('customer.bookings.update')->with('error', 'Booking gagal dibuat.');
        }


        $data = $request->all();

        $booking->update($data);

        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->name !== Auth::user()->name) {
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

    public function showBooking()
    {
        $bookings = Booking::with('service', 'barber')
            ->get();

        return view('bookings.index', compact('bookings'));
    }
    public function editBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // if ($booking->full_name !== Auth::user()->name) {
            // return redirect()->route('customer.bookings.index')->with('error', 'Anda tidak memiliki izin untuk mengedit booking ini.');
        // }

        $barbers = User::role('barber')->get();
        $services = Service::all();
        return view('bookings.edit', compact('booking', 'barbers', 'services'));
    }

    public function updateBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // if ($booking->full_name !== Auth::user()->name) {
        //     return redirect()->route('customer.bookings.index')->with('error', 'Anda tidak memiliki izin untuk mengupdate booking ini.');
        // }
        try {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15',
                'address' => 'nullable|string|max:255',
                'booking_date' => 'required|date',
                // 'booking_time' => 'required|date_format:H:i',
                'service_id' => 'required',
                'selected_barber' => 'nullable|exists:users,id',
                'additional_notes' => 'nullable|string',
                'payment_method' => 'required|string|in:cash,credit_card,online_payment',
            ]);
            $data = $request->all();

            $booking->update($data);

            return redirect()->route('bookingAdmin.index')->with('success', 'Booking berhasil diperbarui.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('bookingAdmin.index')->with('error', 'Booking gagal dibuat.');
        }


        $data = $request->all();

        $booking->update($data);

        return redirect()->route('bookingAdmin.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // if ($booking->name !== Auth::user()->name) {
        //     return redirect()->route('customer.bookings.index')->with('error', 'Anda tidak memiliki izin untuk menghapus booking ini.');
        // }

        $booking->delete();
        return redirect()->route('bookingAdmin.index')->with('success', 'Booking berhasil dihapus.');
    }
}
