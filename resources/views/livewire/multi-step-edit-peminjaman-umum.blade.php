<div>
    <form method="POST" wire:submit.prevent="updatePeminjamanUmum" id="updateForm">
        @csrf
        @method('PUT')
        
        @if ($currentStep == 1)
        <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Tempat <span class="hidden sm:inline-flex sm:ms-2">&</span> <span class="hidden sm:inline-flex sm:ms-2">acara</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="me-2">2</span>
                        Tambahan <span class="hidden sm:inline-flex sm:ms-2">fasilitas</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="me-2">3</span>
                        Waktu <span class="hidden sm:inline-flex sm:ms-2">peminjaman</span>
                    </span>
                </li>
                <li class="flex items-center">
                    <span class="me-2">4</span>
                    Konfirmasi
                </li>
            </ol>
            <div class="step-one mt-6">
                <label for="gedung" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Pilih Gedung</label>
                <select id="gedung_id" name="gedung" aria-label="select example" wire:model="gedung" class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('gedung') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">
                    <option value="" selected>--Pilih Gedung--</option>
                    @foreach($listGedung as $item)
                        <option value="{{ $item->gedung_id }}" {{ old('gedung_id') == $item->gedung_id ? 'selected' : '' }}>{{ $item->nama_gedung }}</option>
                    @endforeach
                </select>
                <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('gedung'){{ $message }}@enderror</span>

                <label for="ruangan" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Pilih Ruangan</label>
                <select name="ruangan" id="ruangan_id" aria-label="select example" wire:model="ruangan" class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('ruangan') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror"">
                    <option value="" selected>--Pilih Ruangan--</option>
                    @foreach($listRuangan as $item)
                        <option value="{{ $item->ruangan_id }}" data-nama-ruangan="{{ $item->nama_ruangan }}" {{ old('ruangan_id') == $item->ruangan_id ? 'selected' : '' }}>{{ $item->nama_ruangan }} (kapasitas: {{ $item->kapasitas }})</option>
                    @endforeach
                </select>
                <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('ruangan'){{ $message }}@enderror</span>

                <label for="jumlah_peserta" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Jumlah Peserta</label>
                    <input type="number" id="jumlah_peserta" name="jumlah_peserta" wire:model="jumlah_peserta" class="form-control block w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-l focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('jumlah_peserta') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror"">
                <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('jumlah_peserta'){{ $message }}@enderror</span>

                <label for="acara" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Acara / Kegiatan</label>
                    <input type="text" id="acara" name="acara" wire:model="acara" class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('acara') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror"">
                <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('acara'){{ $message }}@enderror</span>

                <label for="catatan" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Catatan</label>
                    <textarea id="catatan" name="catatan" wire:model="catatan_acara" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tambahkan Catatan... "></textarea>
                <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('catatan_acara'){{ $message }}@enderror</span>
            </div>
        </div>
        @endif
        

        @if ($currentStep == 2)
        <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Tempat <span class="hidden sm:inline-flex sm:ms-2">&</span> <span class="hidden sm:inline-flex sm:ms-2">acara</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Tambahan <span class="hidden sm:inline-flex sm:ms-2">fasilitas</span>
                    </span>
                <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="me-2">3</span>
                        Waktu <span class="hidden sm:inline-flex sm:ms-2">peminjaman</span>
                    </span>
                </li>
                <li class="flex items-center">
                    <span class="me-2">4</span>
                    Konfirmasi
                </li>
            </ol>
            <div class="step-two mt-6">
                <label for="countries" class="block mb-2 font-medium text-gray-900 dark:text-white">Pilih Konsumsi</label>                 
                <div class="flex items-center mb-4">
                    <!-- <input id="nasi-box-checkbox" type="checkbox" value="nasi-box-checkbox" wire:click="toggleInput(1)" wire:model="konsumsi1" @if($peminjaman->nasi_box) checked @endif class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> -->
                    <label for="nasi-box-checkbox" class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300">Nasi Box</label>
                    <input id="nasi-box-input" type="number" name="nasi_box" wire:model="nasibox_input" class="ml-2 w-20 px-2 py-1 text-l text-gray-900 border rounded focus:outline-none focus:ring focus:ring-blue-500 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-blue-600 dark:bg-gray-700" placeholder="Jumlah">
                </div>
                <div class="flex items-center mb-4">
                    <!-- <input id="snack-checkbox" type="checkbox" value="snack-checkbox" wire:click="toggleInput(2)" wire:model="konsumsi2" @if($peminjaman->snack) checked @endif class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> -->
                    <label for="snack-checkbox" class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300">Snack</label>
                    <input id="snack-input" type="number" name="snack" wire:model="snack_input" class="ml-2 w-20 px-2 py-1 text-l text-gray-900 border rounded focus:outline-none focus:ring focus:ring-blue-500 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-blue-600 dark:bg-gray-700" placeholder="Jumlah">
                </div>
                <div class="flex items-center mb-4">
                    <!-- <input id="prasmanan-checkbox" type="checkbox" value="prasmanan-checkbox" wire:click="toggleInput(3)" @if($peminjaman->prasmanan) checked @endif class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> -->
                    <label for="prasmanan-checkbox" class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300">Prasmanan</label>
                    <input id="prasmanan-input" type="number" name="prasmanan" wire:model="prasmanan_input" class="ml-2 w-20 px-2 py-1 text-l text-gray-900 border rounded focus:outline-none focus:ring focus:ring-blue-500 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-blue-600 dark:bg-gray-700" placeholder="Jumlah">
                </div>
                <!-- <div class="flex items-center">
                    <input id="tidak-checkbox" type="checkbox" value="tidak-checkbox" wire:click="$set('isChecked1', false); $set('isChecked2', false); $set('isChecked3', false);" wire:model="konsumsi" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="tidak-checkbox" class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300">Tidak Ada</label>
                </div> -->
                <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('konsumsi'){{ $message }}@enderror</span>

                    <label for="konsumsi" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Catatan Konsumsi</label>
                    <textarea id="konsumsi" name="konsumsi" wire:model="catatan_konsumsi" class="form-control block p-2.5 w-full text-l text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tambahkan Catatan... "></textarea>
                    <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('catatan_konsumsi'){{ $message }}@enderror</span>

                <label for="countries" class="mt-2 block mb-2 font-medium text-gray-900 dark:text-white">Video Conference</label>
                <div class="flex">
                    <div class="flex items-center me-4">
                        <input id="inline-radio" type="radio" name="vicon" value="1" wire:model="vicon" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required data-parsley-required-message="Pilih salah satu terlebih dahulu">
                        <label for="inline-radio" class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300">Ya</label>
                    </div>
                    <div class="flex items-center me-4">
                        <input id="inline-2-radio" type="radio" name="vicon" value="0" wire:model="vicon" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required data-parsley-required-message="Pilih salah satu terlebih dahulu">
                        <label for="inline-2-radio" class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300">Tidak</label>
                    </div>
                </div>
                <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('vicon'){{ $message }}@enderror</span>

                <label for="countries" class="mt-2 block mb-2 font-medium text-gray-900 dark:text-white">Proyektor</label>
                <div class="flex">
                    <div class="flex items-center me-4">
                        <input id="inline-radio" type="radio" name="proyektor" value="1" wire:model="proyektor" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required data-parsley-required-message="Pilih salah satu terlebih dahulu">
                        <label for="inline-radio" class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300">Ya</label>
                    </div>
                    <div class="flex items-center me-4">
                        <input id="inline-2-radio" type="radio" name="proyektor" value="0" wire:model="proyektor" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required data-parsley-required-message="Pilih salah satu terlebih dahulu">
                        <label for="inline-2-radio" class="ms-2 text-l font-medium text-gray-900 dark:text-gray-300">Tidak</label>
                    </div>
                </div>
                <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('proyektor'){{ $message }}@enderror</span>
            </div>
        </div>
        @endif

        @if ($currentStep == 3)
        <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <ol class="flex mb-5 items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Tempat <span class="hidden sm:inline-flex sm:ms-2">&</span> <span class="hidden sm:inline-flex sm:ms-2">acara</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Tambahan <span class="hidden sm:inline-flex sm:ms-2">fasilitas</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Waktu <span class="hidden sm:inline-flex sm:ms-2">peminjaman</span>
                    </span>
                </li>
                <li class="flex items-center">
                    <span class="me-2">4</span>
                    Konfirmasi
                </li>
            </ol>
            <div class="hidden flex items-center justify-between p-4 text-gray-900 dark:text-white">
                <h4 class="hidden text-lg font-bold text-white dark:text-light text-center w-full" style="font-size: 24px;">Jadwal Meeting PT PLN Indonesia Power UBP Semarang</h4>
            </div>
            <div class="container panel panel-primary">
                <div class="panel-body">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>
                    <div wire:ignore id='calendar'></div>
                </div>
            </div>

            <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="eventDetailModal">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Layer backdrop -->
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    
                    <!-- Modal content -->
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">Detail Acara</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500" id="eventDetailContent"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" id="closeModalBtn">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            @push('scripts')
            <script>
                document.addEventListener('livewire:initialized', function () {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,basicWeek,basicDay'
                        },
                        navLinks: true,
                        editable: true,
                        displayEventTime: true,
                        events: @json($events),
                        eventClick: function(info) {
                            var calEvent = info.event;
                            // Show event details in modal
                            document.getElementById('eventDetailModalLabel').textContent = calEvent.title;
                            var modalBody =
                                '<p><strong>Acara:</strong> ' + calEvent.title + '</p>' +
                                '<p><strong>Start:</strong> ' + calEvent.start.toISOString() + '</p>' +
                                '<p><strong>End:</strong> ' + (calEvent.end ? calEvent.end.toISOString() : '') + '</p>' +
                                '<p><strong>Gedung:</strong> ' + (calEvent.extendedProps.gedung ? calEvent.extendedProps.gedung : '') + '</p>' +
                                '<p><strong>Jumlah Peserta:</strong> ' + (calEvent.extendedProps.jumlah_peserta ? calEvent.extendedProps.jumlah_peserta : '') + '</p>';
                            document.getElementById('eventDetailContent').innerHTML = modalBody;
                            document.getElementById('eventDetailModal').classList.remove('hidden'); // Show modal
                        }
                    });

                    calendar.render();

                    // Close Button
                    document.getElementById('closeModalBtn').addEventListener('click', function () {
                        document.getElementById('eventDetailModal').classList.add('hidden'); // Hide modal
                    });
                });
            </script>
            @endpush
            @error('sudah_dipinjam')
            <div class="flex items-center p-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ $message }}</span>
                </div>
            </div>
            @enderror
            <div class="step-three mt-3">
                <label for="tanggal-peminjaman" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Tanggal Peminjaman</label>
                    <input type="date" id="tanggal" name="tanggal" wire:model="tanggal" class="block w-34 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('tanggal'){{ $message }}@enderror</span>

                <label for="waktu-mulai" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Waktu Mulai</label>
                    <input type="time" id="waktu_mulai" name="waktu_mulai" wire:model="waktu_mulai" class="block w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('waktu_mulai'){{ $message }}@enderror</span>

                <label for="waktu-selesai" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Waktu Selesai</label>
                    <input type="time" id="waktu_selesai" name="waktu_selesai" wire:model="waktu_selesai" class="block w-20 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <span class="mt-2 italic text-xs text-red-600 dark:text-red-500">@error('waktu_selesai'){{ $message }}@enderror</span>     
            </div>
        </div>
        @endif

        @if ($currentStep == 4)
        <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Tempat <span class="hidden sm:inline-flex sm:ms-2">&</span> <span class="hidden sm:inline-flex sm:ms-2">acara</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Tambahan <span class="hidden sm:inline-flex sm:ms-2">fasilitas</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Waktu <span class="hidden sm:inline-flex sm:ms-2">peminjaman</span>
                    </span>
                </li>
                <li class="flex items-center text-blue-600 dark:text-blue-500">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Konfirmasi
                    </span>
                </li>
            </ol>
            <div class="step-four mt-6">
                @php
                    $data = $this->getDataFromSession();
                    $gedung = \App\Models\Gedung::find($data['gedung']);
                    $ruangan = \App\Models\Ruangan::find($data['ruangan']);
                @endphp
                <label for="gedung" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Gedung</label>
                <input id="gedung_id" name="gedung" aria-label="select example" value="{{ $gedung->nama_gedung }}" disabled class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <label for="ruangan" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Ruangan</label>
                <input id="ruangan" name="ruangan" aria-label="select example" value="{{ $ruangan->nama_ruangan }}" disabled class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <label for="jumlah_peserta" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Jumlah Peserta</label>
                    <input type="number" id="jumlah_peserta" name="jumlah_peserta" wire:model="jumlah_peserta" disabled class="form-control block w-16 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-l focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('jumlah_peserta') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">

                <label for="acara" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Acara / Kegiatan</label>
                    <input type="text" id="acara" name="acara" wire:model="acara" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('acara') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror">

                <label for="catatan" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Catatan</label>
                    <textarea id="catatan" name="catatan" wire:model="catatan_acara" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

                <label for="konsumsi" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Konsumsi</label>
                    <input id="konsumsi" name="konsumsi" value="{{ isset($data['nasibox']) && $data['nasibox'] !== '' ? 'nasi box : ' . $data['nasibox'] : '' }}{{ isset($data['snack']) && $data['snack'] !== '' ? (isset($data['nasibox']) && $data['nasibox'] !== '' ? ' , ' : '') . 'snack : ' . $data['snack'] : '' }}{{ isset($data['prasmanan']) && $data['prasmanan'] !== '' ? ((isset($data['nasibox']) && $data['nasibox'] !== '') || (isset($data['snack']) && $data['snack'] !== '') ? ' , ' : '') . 'prasmanan : ' . $data['prasmanan'] : '' }}" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <label for="catatan_konsumsi" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Catatan Konsumsi</label>
                    <textarea id="catatan_konsumsi" name="catatan_konsumsi" wire:model="catatan_konsumsi" disabled class="form-control block p-2.5 w-full text-l text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

                <label for="konsumsi" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Fasilitas</label>
                    <input id="konsumsi" name="konsumsi" value="{{ ($data['vicon'] == 1 && $data['proyektor'] == 1) ? 'video conference , proyektor' : ($data['vicon'] == 1 ? 'video conference' : ($data['proyektor'] == 1 ? 'proyektor' : '')) }}" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <label for="tanggal-peminjaman" class="mt-2 block mb-2 text-l font-medium text-gray-900 dark:text-white">Tanggal dan Waktu Peminjaman</label>
                    <input type="text" id="tanggal" name="tanggal" value="{{ \Carbon\Carbon::parse($data['tanggal'])->isoFormat('D MMMM YYYY', 'Do MMMM YYYY') }} , {{ \Carbon\Carbon::parse($data['waktu_mulai'])->format('H:i')}} - {{ \Carbon\Carbon::parse($data['waktu_selesai'])->format('H:i')}}" disabled class="block w-56 p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">             
            </div>
        </div>
        @endif

        <div class="mt-3">
            @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
            <button type="button" wire:click="decreaseStep()" class="previous text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-l px-5 py-2.5 me-2 dark:focus:ring-yellow-900 float-left">&lt; Previous</button>
            @endif
            @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
            <div class="flex justify-end">
                <button type="button" wire:click="increaseStep()" class="next text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-l px-5 py-2.5 me-2 dark:focus:ring-yellow-900 float-right">Next &gt;</button>
            </div>
            @endif
            @if ($currentStep == 4)
            <div class="flex justify-end">
                <button type="submit" class="focus:outline-none text-black bg-green-100 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-l px-5 py-2.5 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 float-right">Submit</button>
            </div>
            @endif
        </div>
    </form>
</div>
