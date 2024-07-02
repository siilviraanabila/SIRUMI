<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'gedung';

    protected $primaryKey = 'gedung_id';

    protected $fillable = [
        'gedung_id',
        'nama_gedung',
        'gambar',
    ];

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class, 'gedung_id', 'gedung_id');
    }
}
