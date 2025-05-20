<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPembelian extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'alamat',
        'bunga_id',
        'user_id',
        'jumlah',
        'total_harga',
        'metode_pembayaran',
        'tanggal',
        'status',
        'order_id',
    ];

    public function bunga()
    {
        return $this->belongsTo(Bunga::class, 'bunga_id');
    }
}
