<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PegawaiImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pegawai([
            'nip'           => $row[0],
            'id_bidang'        => $row[2],
            'nama_lengkap'          => $row[1], 
        ]);
    }
        public function startRow(): int
    {
        return 2; // Skip the header row
    }
}
