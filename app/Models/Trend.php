<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

     protected $fillable = [
        'R',
        'id_barang',
    ];

    public function barang() {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

}
