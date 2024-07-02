<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use App\User; // Sesuaikan dengan nama model User Anda

class Bidang extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'bidang';

    protected $primaryKey = 'id_bidang';
    protected $fillable = [
        'id_bidang',
        'nama_bidang',
    ];


}