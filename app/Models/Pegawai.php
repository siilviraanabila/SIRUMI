<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use App\Models\User; // Sesuaikan dengan nama model User Anda

class Pegawai extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'pegawai';

    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip',
        'nama_lengkap',
        'id_bidang',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id_bidang');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}