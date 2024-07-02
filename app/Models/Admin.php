<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use App\User; // Sesuaikan dengan nama model User Anda

class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'email',
        'password',
    ];

}

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['title','start_date','end_date'];
}