<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Bunga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function home(){
        $user = Auth::id();
        $cart = Cart::where('user_id', $user)->count();
        $bunga = Bunga::all();
        return view('user.home', compact('bunga', 'cart'));
    }
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari query parameter
        $keyword = $request->input('search');

        // Query data bunga dengan filter pencarian
        $bunga = Bunga::when($keyword, function ($query) use ($keyword) {
            return $query->where('nama', 'like', '%' . $keyword . '%');
        })->paginate(10); // Paginasi 10 data per halaman

        // Kirim data ke view
        return view('user.home', compact('bunga'));
    }
}
