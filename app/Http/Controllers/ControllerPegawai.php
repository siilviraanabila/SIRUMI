<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Gedung;
use App\Models\Fasilitas;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Hash;

class ControllerPegawai extends Controller {
    function pegawai()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('pegawai/pegawai', compact('user'));
    }
    public function dashboardPegawai()
    {
        $item = Gedung::all();

        $folderPath = public_path('foto gedung');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
        $fasilitas = Fasilitas::all();
        $folderPath = public_path('foto fasilitas');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

        if (request()->ajax()) {
            $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
            $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
            $peminjaman = Peminjaman::where('start_date', '>=', $start_date)
                ->where('end_date', '<=', $end_date)
                ->get(['acara', 'start_date', 'end_date']); // Menggunakan alias untuk mengganti nama properti

            return response()->json($peminjaman);
        }

        return view('pegawai/dashboard', ['gedung' => $item, 'fasilitas' => $fasilitas]);
    }

    public function getRegisterPegawai()
    {;
        $user = User::where('id', auth()->user()->id)
            ->select('users.*', 'pegawai.nama_lengkap as nama_pegawai', 'pegawai.*')
            ->first();

        return view('pegawai/registerPegawai');
    }

    public function registerPegawai(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|min:3|max:255',
            'asal_kantor' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:8',
            'role' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nama_lengkap.min' => 'Nama lengkap minimal harus memiliki 3 karakter.',
            'nama_lengkap.max' => 'Nama lengkap maksimal harus memiliki 255 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus memiliki 6 karakter.',
            'password.max' => 'Password maksimal harus memiliki 8 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'asal_kantor.required' => 'Asal kantor harus diisi.',
            'role.required' => 'Role harus diisi.',
        ]);

        User::create([
            'nip'        => $request->input('NIP'),
            'name'           => $request->input('nama_lengkap'),
            'email'           => $request->input('email'),
            'password'       => Hash::make($request->input('password')),
            'role'           => $request->input('role'),
        ]);
        Pegawai::create([
            'nip'            => $request->input('NIP'),
            'nama_lengkap'   => $request->input('nama_lengkap'),
            'asal_kantor'       => $request->input('asal_kantor'),
        ]);

        return redirect()->back()->with('success', 'Akun Pegawai berhasi dibuat!');
    }
    public function storePeminjaman(Request $request)
    {
        $pegawai = Pegawai::where('nip', auth()->user()->nip)->firstOrFail();
        $peminjaman = User::where('id', auth()->user()->id)
            ->join('pegawai', 'users.nip', '=', 'pegawai.nip')
            ->select('users.*', 'pegawai.nama_lengkap')
            ->first();
            
        $gedungId = $request->input('gedung');
        $ruanganId = $request->input('ruangan');
        $namaRuangan = $request->input('nama_ruangan');

        $tanggal = $request->input('tanggal');
        $waktu_mulai = $request->input('waktu_mulai');
        $waktu_selesai = $request->input('waktu_selesai');

        $rapat_mulai = $tanggal . ' ' . $waktu_mulai;
        $rapat_selesai = $tanggal . ' ' . $waktu_selesai;

        // Periksa apakah ruangan sudah dipinjam pada rentang waktu yang diminta
        $existingPeminjaman = Peminjaman::where('ruangan_id', $ruanganId)
            ->where(function ($query) use ($rapat_mulai, $rapat_selesai) {
                $query->where(function ($query) use ($rapat_mulai, $rapat_selesai) {
                        $query->whereBetween('start_date', [$rapat_mulai, $rapat_selesai])
                            ->orWhereBetween('end_date', [$rapat_mulai, $rapat_selesai]);
                    })
                    ->orWhere(function ($query) use ($rapat_mulai, $rapat_selesai) {
                        $query->where('start_date', '<', $rapat_mulai)
                            ->where('end_date', '>', $rapat_mulai);
                    })
                    ->orWhere(function ($query) use ($rapat_mulai, $rapat_selesai) {
                        $query->where('start_date', '<', $rapat_selesai)
                            ->where('end_date', '>', $rapat_selesai);
                    });
            })
            ->exists();

        if ($existingPeminjaman) {
            // Jika ruangan sudah dipinjam, simpan pesan kesalahan dalam session flash
            return redirect()->back()->withInput()->withErrors(['error' => 'Ruangan tersebut sudah dipinjam pada rentang waktu yang diminta']);
        }

        // Lanjutkan dengan menyimpan peminjaman jika ruangan tersedia
        Peminjaman::create([
            'name' => $pegawai->nama_lengkap,
            'bidang' => $pegawai->bidang->nama_bidang,
            'gedung' => $gedungId,
            'ruangan' => $ruanganId,
            'nama_ruangan' => $namaRuangan,
            'jumlah_peserta' => $request->input('jumlah_peserta'),
            'catatan' => $request->input('catatan'),
            'konsumsi' => $request->input('konsumsi'),
            'nasi_box' => $request->input('nasi_box'),
            'snack' => $request->input('snack'),
            'prasmanan' => $request->input('prasmanan'),
            'vicon' => $request->input('vicon'),
            'proyektor' => $request->input('proyektor'),
            'nip' => auth()->user()->nip,
            'acara' => $request->input('acara'),
            'tanggal' => $request->input('tanggal'),
            'waktu_mulai' => $request->input('waktu_mulai'),
            'waktu_selesai' => $request->input('waktu_selesai'),
            'start_date' => $rapat_mulai,
            'end_date' => $rapat_selesai,
        ]);  

        return redirect()->route('getDataPeminjaman')->with('success', 'Peminjaman berhasil disimpan');
    }

    function getDataPeminjaman()
    {
        $peminjaman = User::where('id', auth()->user()->id)
            ->join('pegawai', 'users.nip', '=', 'pegawai.nip')
            ->join('peminjaman', 'pegawai.nip', '=', 'peminjaman.nip')
            ->join('ruangan','peminjaman.ruangan_id', '=','ruangan.ruangan_id')
            ->join('gedung','peminjaman.gedung_id', '=','gedung.gedung_id')
            ->select('users.*', 'peminjaman.*', 'pegawai.*', 'gedung.*', 'ruangan.*')
            ->orderBy('peminjaman.updated_at', 'desc')
            ->get();

        // return dd($peminjaman);
        return view('pegawai/dataPeminjaman', compact('peminjaman'));
    }
    public function getRuanganGedung(Request $request) {
        $gedungId = $request->gedung_id;
        $ruangan = Ruangan::where('gedung_id', $gedungId)->get();
        return response()->json($ruangan);
    }
    function showdataPeminjaman($id)
    {
        $peminjaman = Peminjaman::where('peminjaman_id', $id)
            ->join('pegawai', 'peminjaman.nip', '=', 'pegawai.nip')
            ->join('ruangan','peminjaman.ruangan_id', '=','ruangan.ruangan_id')
            ->join('gedung','peminjaman.gedung_id', '=','gedung.gedung_id')
            ->select('peminjaman.*', 'pegawai.nama_lengkap', 'gedung.*', 'ruangan.*')
            ->first();
        $ruangan = Ruangan::all();
        $pegawai = Pegawai::all();
        $gedung = Gedung::all();

        // return dd($peminjaman);
        return view('pegawai/showdataPeminjaman', compact('peminjaman', 'gedung', 'ruangan', 'pegawai'));
    }
    function deletePeminjaman($id)
    {
    $peminjaman = Peminjaman::where('peminjaman_id', $id)->delete();

    // Tambahkan ini untuk debugging
    // return dd($peminjaman);

    return response()->json(['success' => true]);
    }
    public function editdataPeminjaman($id)
    {
        $peminjaman = Peminjaman::where('peminjaman_id', $id)
            ->join('pegawai', 'peminjaman.nip', '=', 'pegawai.nip')
            ->join('ruangan', 'peminjaman.ruangan_id', '=', 'ruangan.ruangan_id')
            ->join('gedung', 'peminjaman.gedung_id', '=', 'gedung.gedung_id')
            ->select('peminjaman.*', 'pegawai.*', 'gedung.*', 'ruangan.*')
            ->first();

        // Mengambil semua data gedung
        $listGedung = Gedung::all();

        // Mengambil semua data ruangan
        $listRuangan = Ruangan::all();

        // Mengambil gedung yang terpilih (jika ada)
        $selectedGedungId = $peminjaman->gedung_id;
        // ...
        return view('pegawai/editdataPeminjaman', compact('peminjaman',  'listGedung', 'listRuangan', 'selectedGedungId'));
    }


    public function updatePeminjaman(Request $request, $id)
    {
        // Validasi input jika diperlukan
        // $this->validate($request, [...]);

        // Temukan data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json(['error' => 'Data peminjaman tidak ditemukan'], 404);
        }

        // Lakukan pembaruan data peminjaman sesuai kebutuhan
        $peminjaman->update([
            // Sesuaikan dengan kolom-kolom yang ingin diperbarui
            'tanggal'       => request('tanggal'),
            'gedung_id'        => request('gedung_id'),
            'ruangan_id'       => request('ruangan_id'),
            'acara'         => request('acara'),
            'start_date'   => request('waktu_mulai'),
            'end_date'       => request('waktu_selesai'),
            'konsumsi'      => request('konsumsi'),
            'proyektor'     => request('proyektor'),
            'vicon'         => request('vicon'),
            'jumlah_peserta'=> request('jumlah_peserta'),
            'catatan'       => request('catatan'),
            // ... tambahkan kolom lainnya
        ]);

        // Tambahkan ini untuk debugging
        // return dd($peminjaman);

        return redirect()->route('getDataPeminjaman')->with('success', 'Peminjaman berhasil diperbarui');
    }

    function formPeminjamanView(Request $request)
    {
        $gedung = Gedung::all();
        $selectedGedungId = $request->input('gedung');
        $ruangan = Ruangan::all();   

        return view('pegawai/formPeminjaman', compact('gedung','ruangan', 'selectedGedungId'));
    }
    public function getEvent(){
        if(request()->ajax()){
            try {
                $events = [];
                $nip = auth()->user()->nip;
                $peminjaman = Peminjaman::all(); // Get all events
                foreach($peminjaman as $peminjaman) {
                    // Format time according to fullCalendar format ('YYYY-MM-DDTHH:mm:ss')
                    $start = $peminjaman->tanggal . 'T' . $peminjaman->start_date;
                    $end = $peminjaman->tanggal . 'T' . $peminjaman->end_date;
        
                    // Get building name based on building_id
                    $namaGedung = Gedung::find($peminjaman->gedung_id)->nama_gedung;
                    $namaRuangan = Ruangan::find($peminjaman->ruangan_id)->nama_ruangan;
                    $eventColor = ($peminjaman->nip == $nip) ? 'red' : '';

                    $events[] = [
                        'title' => $peminjaman->acara,
                        'start' => $start,
                        'end' => $end,
                        'gedung' => $namaGedung,
                        'ruangan' => $namaRuangan,
                        'jumlah_peserta' => $peminjaman->jumlah_peserta,
                        'color' => $eventColor,
                        'nip' => $peminjaman->nip
                    ];
                }
                return response()->json($events);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        return view('pegawai.FullCalendar'); // Make sure the view name is correct
    }
    
    
    function ruangan()
    {
        $gedungWithRuangan = Gedung::with('ruangan')->get();

        // Inisialisasi array kosong untuk menyimpan peminjaman berdasarkan gedung dan ruangan
        $gedung = Gedung::all();
        return view('pegawai/ruangan', compact('gedung', 'gedungWithRuangan')); 
    }
    public function search(Request $request)
    {
        $query = $request->input('search');
        
        // Cek apakah query pencarian tidak kosong
        if ($query) {
            $gedungWithRuangan = Gedung::with(['ruangan' => function($q) use ($query) {
                $q->where('nama_ruangan', 'LIKE', '%'.$query.'%')
                ->orWhere('description', 'LIKE', '%'.$query.'%')
                ->orWhereHas('gedung', function ($qr) use ($query) {
                    $qr->where('nama_gedung', 'LIKE', '%'.$query.'%');
                });
            }])
            ->whereHas('ruangan', function($q) use ($query) {
                $q->where('nama_ruangan', 'LIKE', '%'.$query.'%')
                ->orWhere('description', 'LIKE', '%'.$query.'%');
            })
            ->orWhere('nama_gedung', 'LIKE', '%'.$query.'%')
            ->get();
        } else {
            // Jika query kosong, tampilkan semua data
            $gedungWithRuangan = Gedung::with('ruangan')->get();
        }

        return view('pegawai/ruangan', compact('gedungWithRuangan'));
    }


}
