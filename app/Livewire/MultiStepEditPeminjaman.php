<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\Gedung;
use App\Models\Ruangan;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MultiStepEditPeminjaman extends Component
{
    public $gedung;
    public $ruangan;
    public $jumlah_peserta;
    public $acara;
    public $catatan_acara;
    public $konsumsi1;
    public $konsumsi2;
    public $konsumsi3;
    public $nasibox_input = null;
    public $snack_input = null;
    public $prasmanan_input = null;
    public $catatan_konsumsi;
    public $vicon;
    public $proyektor;
    public $tanggal;
    public $waktu_mulai;
    public $waktu_selesai;

    public $isChecked1 = false;
    public $isChecked2 = false;
    public $isChecked3 = false;
    public $editID;
    public $totalSteps = 4;
    public $currentStep = 1;

    public function mount($id)
    {
        $this->editID = $id;
        $this->currentStep = 1;

        $peminjaman = Peminjaman::where('peminjaman_id', $id)
            ->join('pegawai', 'peminjaman.nip', '=', 'pegawai.nip')
            ->join('ruangan', 'peminjaman.ruangan_id', '=', 'ruangan.ruangan_id')
            ->join('gedung', 'peminjaman.gedung_id', '=', 'gedung.gedung_id')
            ->select('peminjaman.*', 'pegawai.*', 'gedung.*', 'ruangan.*')
            ->first();

        $this->gedung = $peminjaman->gedung_id;
        $this->ruangan = $peminjaman->ruangan_id;
        $this->jumlah_peserta = $peminjaman->jumlah_peserta;
        $this->acara = $peminjaman->acara;
        $this->catatan_acara = $peminjaman->catatan;
        $this->nasibox_input = $peminjaman->nasi_box;
        $this->snack_input = $peminjaman->snack;
        $this->prasmanan_input = $peminjaman->prasmanan;
        $this->konsumsi = $peminjaman->catatan_konsumsi;
        $this->vicon = $peminjaman->vicon;
        $this->proyektor = $peminjaman->proyektor;
        $this->tanggal = $peminjaman->tanggal;
        $this->waktu_mulai = $peminjaman->start_date;
        $this->waktu_selesai = $peminjaman->end_date;

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

            $existingPeminjaman = Peminjaman::where('ruangan_id', $ruanganId)
                ->where('peminjaman_id', '!=', $this->editID)
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

    public function render()
    {
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

        $peminjaman = Peminjaman::where('peminjaman_id', $this->editID)
            ->join('pegawai', 'peminjaman.nip', '=', 'pegawai.nip')
            ->join('ruangan', 'peminjaman.ruangan_id', '=', 'ruangan.ruangan_id')
            ->join('gedung', 'peminjaman.gedung_id', '=', 'gedung.gedung_id')
            ->select('peminjaman.*', 'pegawai.*', 'gedung.*', 'ruangan.*')
            ->first();

        $listGedung = Gedung::all();
        $listRuangan = Ruangan::all();

        return view('livewire.multi-step-edit-peminjaman', compact('peminjaman','listGedung','listRuangan','events'));
    }
    public function toggleInput($index)
    {
        $this->{'isChecked'.$index} = !$this->{'isChecked'.$index};
        
        if (!$this->{'isChecked1'}) {
            $this->{'nasibox_input'} = null;
        }
        else if (!$this->{'isChecked2'}) {
            $this->{'snack_input'} = null;
        }
        else if (!$this->{'isChecked3'}) {
            $this->{'prasmanan_input'} = null;
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
                'waktu_selesai' => 'required',
            ]);
        }
    }
    public function updatePeminjaman(){
        $pegawai = Pegawai::where('nip', auth()->user()->nip)->firstOrFail();
        $peminjaman = Peminjaman::where('peminjaman_id', $this->editID)
            ->select('peminjaman.*')
            ->first();

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
        Peminjaman::where('peminjaman_id', $this->editID)->update($values);
        return redirect()->route('getDataPeminjaman')->with('success', 'Peminjaman berhasil disimpan');
    }
    public function getEvents()
    {
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
            return $events;
        } catch (\Exception $e) {
            // Return error message if there is any exception
            return ['error' => $e->getMessage()];
        }
    }
}
