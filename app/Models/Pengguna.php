<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'password',
        'status',
        'approved',

        'id_pabrik',
    ];


    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    // public function getAuthIdentifierName()
    // {
    //     return 'username';
    // }

    //password encryption
    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = bcrypt($password);
    // }

    public function pabrik() {
        return $this->belongsTo(Pabrik::class, 'id_pabrik');
    }

}
