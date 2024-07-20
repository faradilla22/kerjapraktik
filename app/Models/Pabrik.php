<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pabrik extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_pabrik',
    ];

    public function bagians() {
        return $this->hasMany(Bagian::class);
    }

    public function barang() {
        return $this->hasMany(Barang::class);
    }
}
