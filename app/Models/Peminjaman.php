<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    public $timestamps = true;
    protected $primaryKey = 'peminjaman_id';

    protected $fillable = [
        'nip',
        'tanggal',
        'start_date', 
        'end_date', 
        'gedung_id',
        'ruangan_id',
        'acara',
        'jumlah_peserta',
        'nasi_box',
        'snack',
        'prasmanan',
        'konsumsi',
        'vicon',
        'proyektor',
        'catatan',
    ];
    // Model Peminjaman
    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'nip');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

}
