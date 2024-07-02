<?php

namespace App\Exports;
use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportRekap implements FromQuery, WithHeadings
{
    public function query()
    {
        return Peminjaman::query()->select('peminjaman_id', 'nip','tanggal' ,'start_date', 'end_date', 'gedung_id', 'ruangan_id', 'acara', 'jumlah_peserta', 'nasi_box', 'snack', 'prasmanan', 'konsumsi', 'vicon', 'proyektor', 'catatan');
    }

    public function headings(): array
    {
        return [
            'Peminjaman_id',
            'NIP',
            'Tanggal',
            'Start_date',
            'End_date',
            'Gedung',
            'Ruangan',
            'Acara',
            'Jumlah Peserta',
            'Nasi Box',
            'Snack',
            'Prasmanan',
            'Konsumsi',
            'Video Conference',
            'Proyektor',
            'Catatan',
        ];
    }
}
