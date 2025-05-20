<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Bunga;
use App\Models\Pembeli;
use App\Models\Riwayat;
use Midtrans\Notification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\StatusPembelian;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Tampilkan form checkout
    public function showCheckoutForm()
    {
        $user = Auth::user();
        $carts = Cart::with('bunga')->where('user_id', $user->id)->get();
        $totalHarga = $carts->sum(function ($cart) {
            return $cart->bunga->harga * $cart->quantity;
        });

        return view('user.form_pemesanan', compact('carts', 'totalHarga'));
    }

    // Proses checkout
    public function processCheckout(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
        ]);

        $user = Auth::user();
        $carts = Cart::with('bunga')->where('user_id', $user->id)->get();
        $totalHarga = $carts->sum(function ($cart) {
            return $cart->bunga->harga * $cart->quantity;
        });

        $request->session()->put('nama', $request->nama);
        $request->session()->put('telepon', $request->telepon);
        $request->session()->put('alamat', $request->alamat);

        Log::info('Session Data:', [
            'nama' => $request->session()->get('nama'),
            'telepon' => $request->session()->get('telepon'),
            'alamat' => $request->session()->get('alamat'),
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        $curlOptions = config('midtrans.curlOptions', []);
        if (!empty($curlOptions)) {
            foreach ($curlOptions as $key => $value) {
                Config::$curlOptions[$key] = $value;
            }
        }

        $orderId = 'ORD-' . now()->timestamp . '-' . Str::random(8);
        $request->session()->put('order_id', $orderId);

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $totalHarga,
        ];

        $customerDetails = [
            'first_name' => $request->nama,
            'email' => $user->email,
            'phone' => $request->telepon,
        ];

        $payload = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($payload);
            Log::info('Snap Token Generated:', ['snapToken' => $snapToken]);

            // Simpan data ke tabel status_pembelians untuk setiap item di keranjang
            foreach ($carts as $cart) {
                StatusPembelian::create([
                    'nama' => $request->nama,
                    'email' => $user->email,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                    'bunga_id' => $cart->bunga->id,
                    'user_id' => $user->id,
                    'jumlah' => $cart->quantity,
                    'total_harga' => $cart->bunga->harga * $cart->quantity,
                    'metode_pembayaran' => null,
                    'tanggal' => now(),
                    'status' => 'pending',
                    'order_id' => $orderId,
                ]);
            }

            return view('user.payment', compact('snapToken', 'totalHarga'));
        } catch (\Exception $e) {
            logger('Midtrans Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Pembayaran gagal: ' . $e->getMessage());
        }
    }

    // Handle pembayaran sukses
    public function handleNotification(Request $request)
    {
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        Log::info('Midtrans Notification:', [
            'transaction_status' => $transactionStatus,
            'order_id' => $orderId,
            'fraud_status' => $fraudStatus,
        ]);

        if ($transactionStatus == 'settlement') {
            StatusPembelian::where('order_id', $orderId)->update([
                'status' => 'settlement',
                'metode_pembayaran' => $notification->payment_type,
            ]);

            Log::info('Pembayaran berhasil dan data pembeli disimpan.');
        } elseif ($transactionStatus == 'pending') {
            Log::info('Pembayaran tertunda.');
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            Log::info('Pembayaran gagal atau dibatalkan.');
        }

        return response()->json(['status' => 'success']);
    }

    public function success(Request $request)
    {
        $user = Auth::user();
        $order_id = $request->session()->get('order_id');

        $pembelian = StatusPembelian::where('order_id', $order_id)->get();

        if ($pembelian->isNotEmpty()) {
            foreach ($pembelian as $item) {
                Pembeli::create([
                    'nama' => $item->nama,
                    'email' => $item->email,
                    'telepon' => $item->telepon,
                    'alamat' => $item->alamat,
                    'bunga_id' => $item->bunga_id,
                    'jumlah' => $item->jumlah,
                    'total_harga' => $item->total_harga,
                ]);

                Riwayat::create([
                    'user_id' => $item->user_id,
                    'nama' => $item->nama,
                    'email' => $item->email,
                    'telepon' => $item->telepon,
                    'alamat' => $item->alamat,
                    'bunga_id' => $item->bunga_id,
                    'jumlah' => $item->jumlah,
                    'total_harga' => $item->total_harga,
                    'tanggal' => now(),
                ]);

                // Update stok bunga
                $bunga = Bunga::find($item->bunga_id);
                $bunga->stock -= $item->jumlah;
                $bunga->save();
            }

            // Hapus data dari status_pembelians dan cart
            StatusPembelian::where('order_id', $order_id)->delete();
            Cart::where('user_id', $user->id)->delete();
        }

        return redirect()->route('user.home')->with('success', 'Pembayaran berhasil! Terima kasih telah berbelanja.');
    }

    public function retryPayment($order_id)
    {
        $user = Auth::user();
        $pembelian = StatusPembelian::where('order_id', $order_id)->get();

        if ($pembelian->isEmpty()) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        // Hitung total harga dari semua item yang terkait dengan order_id
        $totalHarga = $pembelian->sum('total_harga');

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
        $curlOptions = config('midtrans.curlOptions', []);
        if (!empty($curlOptions)) {
            foreach ($curlOptions as $key => $value) {
                Config::$curlOptions[$key] = $value;
            }
        }


        $transactionDetails = [
            'order_id' => $order_id,
            'gross_amount' => $totalHarga,
        ];

        $customerDetails = [
            'first_name' => $pembelian->first()->nama,
            'email' => $pembelian->first()->email,
            'phone' => $pembelian->first()->telepon,
        ];

        $payload = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($payload);
            logger('Snap Token: ' . $snapToken); // Debug

            return view('user.payment', compact('snapToken', 'pembelian', 'totalHarga'));
        } catch (\Exception $e) {
            logger('Midtrans Error: ' . $e->getMessage()); // Debug
            return redirect()->back()->with('error', 'Pembayaran gagal: ' . $e->getMessage());
        }
    }
}
