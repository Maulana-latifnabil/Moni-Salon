<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Request $request)
    {
        // Pastikan data booking tersedia di sesi
        if (!session()->has(['service_ids', 'barber_id', 'booking_date', 'booking_time'])) {
            return redirect()->route('customer.booking.step1')->with('error', 'Silakan lengkapi informasi booking terlebih dahulu.');
        }

        // Ambil data booking dari sesi
        $serviceIds = session('service_ids');
        $services = Service::whereIn('id', $serviceIds)->get();
        $totalPrice = $services->sum('price');

        // Hitung diskon
        $user = Auth::user();
        $bookingCount = $user->bookings()->count();
        $discount = 0;

        if (($bookingCount + 1) % 5 == 0) {
            $discount = $totalPrice * 0.15;
            $totalPrice = $totalPrice - $discount;
        }

        // Buat parameter transaksi Midtrans
        $transaction_details = [
            'order_id' => uniqid(),
            'gross_amount' => $totalPrice,
        ];

        $item_details = $services->map(function ($service) {
            return [
                'id' => $service->id,
                'price' => $service->price,
                'quantity' => 1,
                'name' => $service->name,
            ];
        })->toArray();

        $customer_details = [
            'first_name' => $user->name,
            'email' => $user->email,
            'phone' => $request->phone_number,
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('customer.bookings.payment', compact('snapToken', 'totalPrice'));
        } catch (\Exception $e) {
            return redirect()->route('customer.booking.confirm')->with('error', 'Gagal membuat transaksi. Silakan coba lagi.');
        }
    }

    public function notificationHandler(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        if ($notification->transaction_status == 'capture' || $notification->transaction_status == 'settlement') {
            $booking = Booking::where('order_id', $notification->order_id)->first();
            $booking->status = 'paid';
            $booking->save();
        }

        return response()->json(['status' => 'success']);
    }
}
