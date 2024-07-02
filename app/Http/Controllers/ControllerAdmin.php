<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportExcel;
use App\Models\Admin;
use App\Models\Event;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Gedung;
use App\Models\Ruangan;
use App\Imports\UserImport;
use App\Imports\PegawaiImport;
use App\Imports\UmumImport;
use App\Models\Pegawai;
use App\Models\Umum;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ControllerAdmin extends Controller {

    function admin()
    {
        $user = User::where('id', auth()->user()->id)->first();
        
        return view('admin/admin', compact('user'));
    }
    function dashboardAdmin()
    {
        return view('admin/dashboard');
    }

    public function getRegisterPegawai()
    {

        // Gantilah query ini sesuai dengan kebutuhan Anda
        $user = User::where('id', auth()->user()->id)
            ->join('pegawai', 'users.nip', '=', 'pegawai.nip')
            ->select('users.*', 'pegawai.*')
            ->first();

        $bidangs = Bidang::pluck('nama_bidang', 'id_bidang');

        return view('admin/registerPegawai', compact('user', 'bidangs'));
    }

    public function registerPegawai(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nip' => 'required|numeric',
            'nama_lengkap' => 'required|min:3|max:255',
            'id_bidang' => 'required|numeric',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|max:10',
            'confirm_password' => 'required|same:password',
            'role' => 'required|in:pegawai,umum',
        ], [
            'nip.required' => 'NIP pegawai harus diisi.',
            'nip.numeric' => 'NIP pegawai harus berupa angka.',
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nama_lengkap.min' => 'Nama lengkap minimal harus memiliki 3 karakter.',
            'nama_lengkap.max' => 'Nama lengkap maksimal harus memiliki 255 karakter.',
            'id_bidang.required' => 'Bidang harus dipilih.',
            'id_bidang.numeric' => 'Bidang harus dipilih dengan benar.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal harus memiliki 255 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal harus memiliki 6 karakter.',
            'password.max' => 'Password maksimal harus memiliki 10 karakter.',
            'confirm_password.required' => 'Konfirmasi password harus diisi.',
            'confirm_password.same' => 'Konfirmasi password harus sama dengan password.',
            'role.required' => 'Role harus dipilih.',
            'role.in' => 'Role harus salah satu dari pegawai atau umum.',
        ]);
         
        
        // Jika validasi berhasil, lanjutkan dengan membuat akun
        $user = User::create([
            'nip'        => $validatedData['nip'],
            'email'      => $validatedData['email'],
            'password'   => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        Pegawai::create([
            'nip'  => $validatedData['nip'],
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'id_bidang'       => $validatedData['id_bidang'],
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Akun Pegawai berhasil dibuat!');
    }

    public function getImportPegawai()
    {
        return view('admin/importPegawai');
    }
    public function importPegawai(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new UserImport, request()->file('file'));
        Excel::import(new PegawaiImport, request()->file('file'));

        return redirect()->back()->with('success', 'Import pegawai berhasil');
    }
    
    function getPegawai()
    {
        $pegawai = Pegawai::join('users', 'pegawai.nip', '=', 'users.nip')
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view('admin/daftarPegawai', compact('pegawai'));
    }

    // update data mahasiswa
    public function editPegawai($nip)
    {
        $pegawai = Pegawai::where('pegawai.nip', $nip)
            ->join('users', 'pegawai.nip', '=', 'users.nip')
            ->select('users.*', 'pegawai.*')
            ->first();

        $user = User::where('nip', $nip)->first();
        $bidangs = Bidang::pluck('nama_bidang', 'id_bidang');

        return view('admin/editPegawai', compact('pegawai', 'user', 'bidangs'));
    }

    public function updatePegawai(Request $request, $nip)
    {
        // Temukan data pegawai berdasarkan NIP
        $pegawai = Pegawai::where('nip', $nip)->first();
        $user = User::where('nip', $nip)->first();

        if (!$pegawai) {
            return response()->json(['error' => 'Data pegawai tidak ditemukan'], 404);
        }

        // Lakukan validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nip' => 'required|numeric',
            'nama_lengkap' => 'required|min:3|max:255',
            'id_bidang' => 'required|numeric',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|max:10',
            'confirm_password' => 'required|same:password',
            'role' => 'required|in:pegawai,umum,admin',
        ]);

        // Update model Pegawai dengan data yang valid
        $pegawai->update([
            'nip' => $validatedData['nip'],
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'password' => bcrypt($validatedData['password']),
            'id_bidang' => $validatedData['id_bidang'],
        ]);

        // Update model User dengan data yang valid
        $user->update([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'nip' => $validatedData['nip'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Redirect ke halaman daftar pegawai dengan pesan sukses
        return redirect()->route('getDaftarPegawai')->with('success', 'Data Pegawai berhasil diperbarui');
    }
        
    public function deletePegawai($nip)
    {
        try {
            $pegawai = Pegawai::where('nip', $nip)->firstOrFail();
            $pegawai->delete();

            $user = User::where('nip', $nip)->firstOrFail();
            $user->delete();

            return response()->json(['message' => 'Pegawai and associated User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete pegawai and associated user.']);
        }
    }


    public function getEvent(){
        if(request()->ajax()){
            try {
                $events = [];
                $peminjaman = Peminjaman::all(); // Get all events
                foreach($peminjaman as $peminjaman) {
                    // Format time according to fullCalendar format ('YYYY-MM-DDTHH:mm:ss')
                    $start = $peminjaman->tanggal . 'T' . $peminjaman->start_date;
                    $end = $peminjaman->tanggal . 'T' . $peminjaman->end_date;
        
                    // Get building name based on building_id
                    $namaGedung = Gedung::find($peminjaman->gedung_id)->nama_gedung;
                    $namaRuangan = Ruangan::find($peminjaman->ruangan_id)->nama_ruangan;
        
                    $events[] = [
                        'title' => $peminjaman->acara,
                        'start' => $start,
                        'end' => $end,
                        'gedung' => $namaGedung,
                        'ruangan' => $namaRuangan,
                        'jumlah_peserta' => $peminjaman->jumlah_peserta
                    ];
                }
                return response()->json($events);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        return view('admin.FullCalendar'); // Make sure the view name is correct
    }
        
    public function downloadTemplate()
    {
        $templatePath = public_path('templates/template.xlsx');
        return response()->download($templatePath, 'template.xlsx');
    }
}