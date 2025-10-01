<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'kode', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class); // N To 1
    }   
}
