<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_bagian',
        'id_pabrik',
    ];

    // Relasi ke model pabrik
    public function pabrik() {
        return $this->belongsTo(Pabrik::class);
    }

    public function barang() {
        return $this->hasMany(Barang::class);
    }
}
