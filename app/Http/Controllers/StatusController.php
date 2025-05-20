<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPembelian;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    function view(){
        $user = Auth::user(); // Ambil user yang sedang login
        $pembelian = StatusPembelian::with('bunga')->where('user_id', $user->id)->get(); // Ambil riwayat berdasarkan user_id
        return view('user.status_pembayaran', compact('pembelian'));
    }
}
