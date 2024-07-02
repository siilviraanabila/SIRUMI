<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nip'       => $row[0], // Sesuaikan indeks kolom dengan struktur Excel
            'email'     => $row[3], // Sesuaikan indeks kolom dengan struktur Excel
            'role'      => $row[4], // Sesuaikan indeks kolom dengan struktur Excel
            'password'  => bcrypt($row[5]), // Sesuaikan indeks kolom dengan struktur Excel
        ]);
    }
        public function startRow(): int
    {
        return 2; // Skip the header row
    }
}
