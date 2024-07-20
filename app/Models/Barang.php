<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

     protected $fillable = [
        'status',
        'item_no',
        'item_name',
        'S',
        'L',
        'P',
        'E', 
        'B',
        'H',
        'ECR',
        'R',
        'RR',


        'id_pabrik',
        'id_bagian',
    ];

    // Relasi ke model pabrik
    public function pabrik() {
        return $this->belongsTo(Pabrik::class);
    }

    public function bagians() {
        return $this->hasMany(Bagian::class);
    }
}
