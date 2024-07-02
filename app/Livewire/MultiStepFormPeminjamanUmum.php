<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Gedung;
use App\Models\Ruangan;
use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MultiStepFormPeminjamanUmum extends Component
{
    public $gedung;
    public $ruangan;
    public $jumlah_peserta;
    public $acara;
    public $catatan_acara;
    public $konsumsi = [];
    public $nasibox_input;
    public $snack_input;
    public $prasmanan_input;
    public $catatan_konsumsi;
    public $vicon;
    public $proyektor;
    public $tanggal;
    public $waktu_mulai;
    public $waktu_selesai;

    public $totalSteps = 4;
    public $currentStep = 1;

    protected $rules = [
        
    ];
    // protected $messages = [
    //     'gedung.required' => 'The Email Address cannot be empty.',
    //     'ruangan.required' => 'The Email Address format is not valid.',
    // ];

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function render()
    {
        $listGedung = Gedung::all();
        $listRuangan = Ruangan::all();
        return view('livewire.multi-step-form-peminjaman-umum', compact('listGedung','listRuangan'));
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        if($this->currentStep == 1){
            $ruangan = Ruangan::find($this->ruangan);
            if ($ruangan && $this->jumlah_peserta > $ruangan->kapasitas) {
                $this->addError('jumlah_peserta', 'Jumlah peserta melebihi kapasitas ruangan yang dipilih.');
                return;
            }
        }
        if($this->currentStep == 3){
            $gedungId = $this->gedung;
            $ruanganId = $this->ruangan;

            $tanggal = $this->tanggal;
            $waktu_mulai = $this->waktu_mulai;
            $waktu_selesai = $this->waktu_selesai;

            $rapat_mulai = $tanggal . ' ' . $waktu_mulai;
            $rapat_selesai = $tanggal . ' ' . $waktu_selesai;

            // Periksa apakah ruangan sudah dipinjam pada rentang waktu yang diminta
            $existingPeminjaman = Peminjaman::where('ruangan_id', $ruanganId)
                ->where(function ($query) use ($rapat_mulai, $rapat_selesai) {
                    $query->where(function ($query) use ($rapat_mulai, $rapat_selesai) {
                            $query->whereBetween(DB::raw("CONCAT(tanggal, ' ', start_date)"), [$rapat_mulai, $rapat_selesai])
                                ->orWhereBetween(DB::raw("CONCAT(tanggal, ' ', end_date)"), [$rapat_mulai, $rapat_selesai]);
                        })
                        ->orWhere(function ($query) use ($rapat_mulai, $rapat_selesai) {
                            $query->where(DB::raw("CONCAT(tanggal, ' ', start_date)"), '<', $rapat_mulai)
                                ->where(DB::raw("CONCAT(tanggal, ' ', end_date)"), '>', $rapat_mulai);
                        })
                        ->orWhere(function ($query) use ($rapat_mulai, $rapat_selesai) {
                            $query->where(DB::raw("CONCAT(tanggal, ' ', start_date)"), '<', $rapat_selesai)
                                ->where(DB::raw("CONCAT(tanggal, ' ', end_date)"), '>', $rapat_selesai);
                        });
                })
                ->exists();

            if ($existingPeminjaman) {
                $this->addError('sudah_dipinjam', 'Ruangan tersebut sudah dipinjam pada rentang waktu yang diminta.');
                return;
            }
            if ($rapat_mulai > $rapat_selesai) {
                $this->addError('waktu_mulai', 'Waktu mulai tidak boleh lebih dari waktu selesai.');
                return;
            }
        }
        $this->saveDataToSession();
        $this->currentStep++;
        if($this->currentStep > $this->totalSteps){
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    private function saveDataToSession()
    {
        Session::put('peminjaman', [
            'gedung' => $this->gedung,
            'ruangan' => $this->ruangan,
            'jumlah_peserta' => $this->jumlah_peserta,
            'acara' => $this->acara,
            'catatan_acara' => $this->catatan_acara,
            'nasibox' => $this->nasibox_input,
            'snack' => $this->snack_input,
            'prasmanan' => $this->prasmanan_input,
            'catatan_konsumsi' => $this->catatan_konsumsi,
            'vicon' => $this->vicon,
            'proyektor' => $this->proyektor,
            'tanggal' => $this->tanggal,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,           
        ]);
    }
    public function getDataFromSession()
    {
        return Session::get('peminjaman');
    }

    public function validateData()
    {
        if($this->currentStep == 1){
            $this->validate([
                'gedung' => 'required',
                'ruangan' => 'required',
                'jumlah_peserta' => 'required|numeric|min:1',
                'acara' => 'required',
                'catatan_acara' => 'nullable'
            ]);
        }elseif($this->currentStep == 2){
            $this->validate([
                'vicon' => 'required',
                'proyektor' => 'required'
            ]);
        }elseif($this->currentStep == 3){
            $this->validate([
                'tanggal' => 'required',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required'
            ]);
        }
    }
    public function storePeminjamanUmum(){
        $pegawai = Pegawai::where('nip', auth()->user()->nip)->firstOrFail();

        $values = array(
            'nip' => $pegawai->nip,
            'tanggal' => $this->tanggal,
            'start_date' => $this->waktu_mulai,
            'end_date' => $this->waktu_selesai,
            'gedung_id' => $this->gedung,
            'ruangan_id' => $this->ruangan,
            'acara' => $this->acara,
            'jumlah_peserta' => $this->jumlah_peserta,
            'nasi_box' => $this->nasibox_input,
            'snack' => $this->snack_input,
            'prasmanan' => $this->prasmanan_input,
            'konsumsi' => $this->catatan_konsumsi,
            'vicon' => $this->vicon,
            'proyektor' => $this->proyektor,
            'catatan' => $this->catatan_acara,
        );
        Peminjaman::create($values);
        return redirect()->route('getDataPeminjamanUmum')->with('success', 'Peminjaman berhasil disimpan');

    }
}
