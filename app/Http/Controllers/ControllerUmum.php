<?php
namespace App\Http\Controllers;

use App\Exports\ExportRekap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Pegawai;
use App\Models\Gedung;
use App\Models\Ruangan;
use App\Models\Event;
use App\Models\User;
use App\Models\Peminjaman;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class ControllerUmum extends Controller {
    function umum()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('umum/umum', compact('user'));
    }
    public function dashboardUmum()
    {
        // Ambil semua gedung beserta ruangan-ruangannya
        $gedungWithRuangan = Gedung::with('ruangan')->get();

        // Inisialisasi array kosong untuk menyimpan peminjaman berdasarkan gedung dan ruangan
        $peminjamanByGedungDanRuangan = [];

        // Ambil semua peminjaman dengan relasi ke ruangan
        $peminjamans = Peminjaman::with('ruangan', 'user')->whereDate('tanggal', '>=', now())->get();
        $peminjaman = Peminjaman::join('ruangan', 'peminjaman.ruangan_id', '=', 'ruangan.ruangan_id')->whereDate('tanggal', '=', now())->get();

        // Kelompokkan peminjaman berdasarkan gedung dan ruangan yang memiliki peminjaman
        foreach ($gedungWithRuangan as $gedung) {
            foreach ($gedung->ruangan as $ruangan) {
                // Filter peminjaman berdasarkan ruangan saat ini
                $peminjamanRuangan = $peminjamans->where('gedung_id', $gedung->gedung_id)
                                                ->where('ruangan_id', $ruangan->ruangan_id);
                

                    $peminjamanByGedungDanRuangan[$gedung->nama_gedung][$ruangan->nama_ruangan] = $peminjamanRuangan;
                // }
            }
        }

        // Kembalikan view dengan data yang sudah diatur
        return view('umum/dashboardUmum', compact('peminjamanByGedungDanRuangan', 'peminjaman', 'peminjamans'));
    }

    public function getRegisterUmum()
    {;
        $user = User::where('id', auth()->user()->id)
            ->select('users.*', 'umum.nama_lengkap as nama_umum', 'umum.*')
            ->first();

        return view('umum/registerUmum');
    }

    public function registerUmum(Request $request)
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

    
    public function getRuanganByGedung(Request $request) {
        $gedungId = $request->gedung_id;
        $ruangan = Ruangan::where('id_gedung', $gedungId)->get();
        return response()->json($ruangan);
    }
    public function fetchByGedung(Request $request)
    {
        $gedungId = $request->input('gedung_id');
        $ruangan = Ruangan::where('gedung_id', $gedungId)->get();
        return response()->json($ruangan);
    }
    function tambahFasilitasView()
    {
        return view('umum/tambahFasilitas');
    }
    
    public function tambahRuangan()
    {
        $gedungWithRuangan = Gedung::with('ruangan')->get();

        // Inisialisasi array kosong untuk menyimpan peminjaman berdasarkan gedung dan ruangan
        $gedung = Gedung::all();
    
        return view('umum/tambahRuangan', compact('gedung', 'gedungWithRuangan'));
    }

    public function storeTambahRuangan(Request $request) 
    {
        // Validasi form
        $request->validate([
            'nama_ruangan' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'kapasitas' => 'required',
        ]);
        
        $folderPath = public_path('foto ruangan');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
        $namaFoto = $request->input('nama_ruangan') . '.' . $request->file('image')->extension(); 
        $imagePath = $request->file('image')->move($folderPath, $namaFoto);


        // Membuat entri baru di database
        Ruangan::create([
            'gedung_id' => $request->input('gedung'),
            'nama_ruangan' => $request->input('nama_ruangan'),
            'image' => $namaFoto,
            'description' => $request->input('description'),
            'kapasitas' => $request->input('kapasitas'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan');
    }
    function editRuangan($id) 
    {
        $ruangan = Ruangan::findOrFail($id);
        $gedung = Gedung::all();

        // return dd($peminjaman);
        return view('umum/editRuangan', compact('ruangan' , 'gedung'));
    }
    public function updateRuangan(Request $request, $id)
    {
        // Temukan data konsumsi berdasarkan ID
        $ruangan = Ruangan::findOrFail($id);

        // Jika ada file gambar yang diupload
    if ($request->hasFile('image')) {
        // Menghapus gambar lama jika ada
        $folderPath = public_path('foto ruangan');
        $filePath = $folderPath . '/' . $ruangan->image;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        // Memindahkan gambar baru ke folder yang ditentukan
            $namaFoto = $request->input('nama_ruangan') . '.' . $request->file('image')->extension();
            $imagePath = $request->file('image')->move($folderPath, $namaFoto);
            $ruangan->image = $namaFoto;
        }

        // Lakukan pembaruan data konsumsi sesuai kebutuhan
        $ruangan->gedung_id = $request->input('gedung');
        $ruangan->nama_ruangan = $request->input('nama_ruangan');
        $ruangan->kapasitas = $request->input('kapasitas');
        $ruangan->description = $request->input('description');
        $ruangan->save();

        // return dd($ruangan->image);
        return redirect()->route('tambahRuangan')->with('success', 'Ruangan berhasil diperbarui');
    }
    function deleteRuangan($id) 
    {
    $ruangan = Ruangan::where('ruangan_id', $id)->delete();

    return response()->json(['success' => true]);
    }
    function ruanganUmum()
    {
        $gedungWithRuangan = Gedung::with('ruangan')->get();

        // Inisialisasi array kosong untuk menyimpan peminjaman berdasarkan gedung dan ruangan
        $gedung = Gedung::all();
        return view('umum/ruanganUmum', compact('gedung', 'gedungWithRuangan')); // Meneruskan data ke view
    }
    public function tambahGedung()
    {
        $item = Gedung::all();
        $folderPath = public_path('foto gedung');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
    
        return view('umum/tambahGedung', ['gedung' => $item]);
    }

    public function storeTambahGedung(Request $request) 
    {
        // Validasi form
        $request->validate([
            'nama_gedung' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $folderPath = public_path('foto gedung');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
        $namaFoto = $request->input('nama_gedung') . '.' . $request->file('gambar')->extension(); 
        $imagePath = $request->file('gambar')->move($folderPath, $namaFoto);

        // Membuat entri baru di database
        Gedung::create([
            'nama_gedung' => $request->input('nama_gedung'),
            'gambar' => $namaFoto,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Gedung berhasil ditambahkan');
    }
    function editGedung($id)
    {
        $gedung = Gedung::where('gedung_id', $id)->firstOrFail();

        return view('umum/editGedung', compact('gedung'));
    }

    public function updateGedung(Request $request, $id)
    {
        // Validasi input jika diperlukan
        // $this->validate($request, [...]);

        // Temukan data konsumsi berdasarkan ID
        $gedung = Gedung::findOrFail($id);

        if (!$gedung) {
            return response()->json(['error' => 'Data Gedung tidak ditemukan'], 404);
        }

        // Periksa apakah file gambar diunggah
        if ($request->hasFile('gambar')) {
            $folderPath = public_path('foto gedung');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            
            // Dapatkan ekstensi file gambar yang diunggah
            $extension = $request->file('gambar')->extension();
            // Bangun nama file dengan menggunakan judul dan ekstensi
            $namaFoto = $request->title . '.' . $extension;
            // Pindahkan file gambar ke folder yang ditentukan
            $imagePath = $request->file('gambar')->move($folderPath, $namaFoto);

            // Update kolom 'image' dengan nama file yang baru
            $gedung->gambar = $namaFoto;
        }

        // Lakukan pembaruan data konsumsi sesuai kebutuhan
        $gedung->nama_gedung = $request->nama_gedung;
        $gedung->save();

        // Tambahkan ini untuk debugging
        // return dd($konsumsi);

        return redirect()->route('tambahGedung')->with('success', 'Gedung berhasil diperbarui');
    }
    function deleteGedung($id)
    {
    $gedung = Gedung::where('Gedung_id', $id)->delete();

    // Tambahkan ini untuk debugging
    // return dd($peminjaman);

    return response()->json(['success' => true]);
    }

    public function getRekapPeminjaman()
    {
        // Mengambil semua data peminjaman dengan eager loading untuk relasi ruangan dan gedung
        $peminjaman = Peminjaman::join('ruangan', 'peminjaman.ruangan_id', '=', 'ruangan.ruangan_id')
            ->join('gedung', 'peminjaman.gedung_id', '=', 'gedung.gedung_id')
            ->select('peminjaman.*', 'gedung.*', 'ruangan.*')
            ->orderBy('peminjaman.updated_at', 'desc')
            ->get();
    
        // Mengambil semua data ruangan dan gedung
        $ruangan = Ruangan::all();
        $gedung = Gedung::all();
        
        // return dd($peminjaman);
        // Mengembalikan data peminjaman untuk ditampilkan atau untuk diproses lebih lanjut
        return view('umum/rekapPeminjaman', compact('peminjaman', 'gedung', 'ruangan'));
    }    

    function cetakRekap()
    {
        $peminjaman = Peminjaman::join('ruangan', 'peminjaman.ruangan_id', '=', 'ruangan.ruangan_id')
            ->join('gedung', 'peminjaman.gedung_id', '=', 'gedung.gedung_id')
            ->select('peminjaman.*', 'gedung.*', 'ruangan.*')
            ->get();

        $ruangan = Ruangan::all();
        $gedung = Gedung::all();

        return view('umum/cetakRekap', compact('peminjaman', 'gedung', 'ruangan'));
    }
    function formPeminjamanUmum(Request $request)
    {
        $gedung = Gedung::all();
        $selectedGedungId = $request->input('gedung');
        $ruangan = Ruangan::all();      

        return view('umum/formPeminjamanUmum', compact('gedung','ruangan', 'selectedGedungId') );
    }
    public function storePeminjamanUmum(Request $request)
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

        return redirect()->route('getDataPeminjamanUmum')->with('success', 'Peminjaman berhasil disimpan');
    }

    function getDataPeminjamanUmum()
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
        return view('umum/dataPeminjamanUmum', compact('peminjaman'));
    }

    function showdataPeminjamanUmum($id)
    {
        $peminjaman = Peminjaman::where('peminjaman_id', $id)
            ->join('pegawai', 'peminjaman.nip', '=', 'pegawai.nip')
            ->join('ruangan','peminjaman.ruangan_id', '=','ruangan.ruangan_id')
            ->join('gedung','peminjaman.gedung_id', '=','gedung.gedung_id')
            ->select('peminjaman.*', 'pegawai.nama_lengkap','gedung.*','ruangan.*')
            ->first();
        $ruangan = Ruangan::all();
        $pegawai = Pegawai::all();
        $gedung = Gedung::all();
            
        return view('umum/showdataPeminjamanUmum', compact('peminjaman','ruangan','gedung'));
    }

    function deletePeminjamanUmum($id)
    {
    $peminjaman = Peminjaman::where('peminjaman_id', $id)->delete();

    // Tambahkan ini untuk debugging
    // return dd($peminjaman);

    return response()->json(['success' => true]);
    }

    function editdataPeminjamanUmum(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('peminjaman_id', $id)
            ->join('pegawai', 'peminjaman.nip', '=', 'pegawai.nip')
            ->join('ruangan', 'peminjaman.ruangan_id', '=', 'ruangan.ruangan_id')
            ->join('gedung', 'peminjaman.gedung_id', '=', 'gedung.gedung_id')
            ->select('peminjaman.*', 'pegawai.nama_lengkap', 'gedung.*', 'ruangan.*')
            ->first();

        // Mengambil semua data gedung
        $gedung = Gedung::all();

        // Mengambil semua data ruangan
        $ruangan = Ruangan::all();

        // Mengambil gedung yang terpilih (jika ada)
        $selectedGedungId = $peminjaman->gedung_id;

        return view('umum/editdataPeminjamanUmum', compact('peminjaman', 'gedung', 'ruangan', 'selectedGedungId'));
    }


    public function updatedataPeminjamanUmum(Request $request, $id)
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
            'gedung' => request('gedung_id'),
            'ruangan' => request('ruangan_id'),
            'acara'         => request('acara'),
            'start_date'   => request('waktu_mulai'),
            'end_date' => request('waktu_selesai'),
            'konsumsi'      => request('konsumsi'),
            'proyektor'     => request('proyektor'),
            'vicon'         => request('vicon'),
            'jumlah_peserta'=> request('jumlah_peserta'),
            'catatan'       => request('catatan'),
        ]);

        // Tambahkan ini untuk debugging
        // return dd($peminjaman);

        return redirect()->route('getDataPeminjamanUmum')->with('success', 'Peminjaman berhasil diperbarui');
    }


    public function getUpdatedDataUmum(Request $request)
    {
        
        $updatedData = Peminjaman::where('tanggal', '>=', now())->get(['id', 'acara', 'tanggal', 'waktu_mulai', 'waktu_selesai']);

        $formattedData = $updatedData->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->acara,
                'start' => $event->tanggal . ' ' . $event->waktu_mulai,
                'end' => $event->tanggal . ' ' . $event->waktu_selesai,
            ];
        });

        return response()->json($formattedData);
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
        return view('umum.FullCalendar'); // Make sure the view name is correct
    }
    public function export_excel() 
    {
        return Excel::download(new ExportRekap, "rekap-peminjaman.xlsx");
    }
    public function showRekapPeminjamanByDate(Request $request)
    {
        // Mengambil tanggal yang dipilih dari request
        $selectedDate = $request->date;

        // Jika tidak ada tanggal yang dipilih, atur defaultnya sebagai hari ini
        if (!$selectedDate) {
            $selectedDate = Carbon::today()->toDateString();
        }

        // Query untuk mengambil data peminjaman hanya untuk tanggal yang dipilih
        $peminjaman = Peminjaman::whereDate('start_date', $selectedDate)->get();

        return view('umum/rekapPeminjaman')->with('peminjaman', $peminjaman);
    }

    public function searchUmum(Request $request)
    {
        $query = $request->input('searchUmum');
        
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

        return view('umum/ruanganUmum', compact('gedungWithRuangan'));
    }

}

