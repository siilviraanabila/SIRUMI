<?php

namespace App\Exports;
use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcel implements WithHeadings
{

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Bidang',
            'Email',
            'Role',
            'Password',
        ];
    }
}
