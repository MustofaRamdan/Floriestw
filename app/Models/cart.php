<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bunga_id',
        'quantity', // Pastikan kolom ini ada
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Bunga
    public function bunga()
    {
        return $this->belongsTo(Bunga::class, 'bunga_id');
    }
}
