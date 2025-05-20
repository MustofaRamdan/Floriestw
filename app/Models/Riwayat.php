<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayat';
    protected $fillable = [
        'user_id', // Tambahkan user_id
        'nama',
        'email',
        'telepon',
        'alamat',
        'bunga_id',
        'jumlah',
        'total_harga',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function bunga()
    {
        return $this->belongsTo(Bunga::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Tambahkan relasi ke user
    }
}
