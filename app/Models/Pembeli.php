<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $table = 'pembeli';
    protected $fillable = ['nama', 'email', 'telepon', 'alamat', 'bunga_id', 'jumlah', 'total_harga'];

    public function bunga()
    {
        return $this->belongsTo(Bunga::class);
    }
}
