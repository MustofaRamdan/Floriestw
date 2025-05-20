<?php

namespace App\Http\Controllers;

use App\Models\Bunga;
use Illuminate\Http\Request;
use App\Models\Cart; // Ganti model
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $bunga_id = $request->bunga_id;
        $bunga = Bunga::find($request->bunga_id);

        if ($bunga->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok bunga ini sudah habis.');

        }

        // Cek apakah item sudah ada di cart
        $cart = Cart::where('user_id', $user->id)
                    ->where('bunga_id', $bunga_id)
                    ->first();

        if ($cart) {
            // Jika sudah ada, tambah quantity-nya
            $cart->quantity += 1;
            $cart->save();
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => $user->id,
                'bunga_id' => $bunga_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke cart!');
    }

    public function removeFromCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari cart!');
    }

    public function viewCart()
    {
        $user = Auth::user();
        $carts = Cart::with('bunga')->where('user_id', $user->id)->get();
        $totalHarga = 0;
        $isStockUnavailable = $carts->contains(function($item) {
            return $item->bunga->stock == 0;
        });
        foreach ($carts as $cart) {
            $totalHarga += $cart->bunga->harga * $cart->quantity;
        }

        return view('user.cart', compact('carts', 'totalHarga', 'isStockUnavailable'));
    }           

    public function updateQuantity(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Cari item cart berdasarkan ID
        $cart = Cart::findOrFail($id);

        // Update quantity
        $cart->quantity = $request->quantity;
        $cart->save();

        // Berikan respons sukses
        return response()->json([
            'success' => true,
            'subtotal' => $cart->bunga->harga * $cart->quantity,
        ]);
    }
}
