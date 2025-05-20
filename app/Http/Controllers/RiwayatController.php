<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil user yang sedang login
        $riwayat = Riwayat::with('bunga')->where('user_id', $user->id)->get(); // Ambil riwayat berdasarkan user_id
        return view('user.riwayat', compact('riwayat'));
    }
}
