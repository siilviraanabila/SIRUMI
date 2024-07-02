<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman; //add Event Model

class CalendarController extends Controller
{
    public function index()
    {
        // Ambil semua peminjaman dari database
        $peminjaman = Peminjaman::all();
        
        // Format data peminjaman sesuai kebutuhan kalender
        $events = [];
        foreach ($peminjaman as $peminjaman) {
            $events[] = [
                'title' => $peminjaman->acara, // Judul acara
                'start' => $peminjaman->start_date, // Tanggal mulai acara
                'end' => $peminjaman->end_date, // Tanggal selesai acara
                // Tambahkan properti lain jika diperlukan
            ];
        }
        
        // Kirim data ke view kalender
        return view('calendar.index', compact('events'));
    }
}
