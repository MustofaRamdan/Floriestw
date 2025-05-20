<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bunga extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'harga', 'image', 'stock'];

        // Relasi ke model Cart
        public function carts()
        {
            return $this->hasMany(Cart::class, 'bunga_id'); // Pastikan foreign key 'bunga_id' disebutkan
        }

        public function statusPembelians()
        {
            return $this->hasMany(StatusPembelian::class, 'bunga_id');
        }
}
