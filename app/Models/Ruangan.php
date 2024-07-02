<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'ruangan_id';

    protected $fillable = [
        'ruangan_id',
        'gedung_id',
        'nama_ruangan',
        'image',
        'description',
        'kapasitas',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'ruangan_id', 'ruangan_id');
    }
}
    
