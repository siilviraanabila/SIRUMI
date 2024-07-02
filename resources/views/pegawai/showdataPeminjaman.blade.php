<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Show Data Peminjaman</title>
    @include('layouts.header')
</head>

<body style="background-color: #D3F0FF;">
    @include('layouts.sidebar')
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
            <div id="halaman" class="w-full h-fit bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between p-2 mb-4 border-b dark:border-primary text-gray-900 dark:text-white">
                    <a href="{{ route('getDataPeminjaman') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-l px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Back
                    </a>
                    <h4 class="text-lg font-bold text-black dark:text-light text-center w-full" style="font-size: 24px;">Detail Data Peminjaman</h4>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <!-- Kolom Kiri -->
                    <div>
                        <div class="mb-4">
                            <label for="nama_lengkap" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Nama Peminjam</label>
                            <input type="text" id="nama_lengkap" value="{{ $peminjaman->nama_lengkap }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="tanggal" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Tanggal</label>
                            <input type="text" id="tanggal" value="{{$peminjaman->tanggal}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="gedung" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Gedung</label>
                            <input type="text" id="gedung" value="{{ $peminjaman->nama_gedung}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="ruangan" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Ruangan</label>
                            <input type="text" id="ruangan" value="{{ $peminjaman->nama_ruangan}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                    </div>
                    <div>
                        <div class="mb-4">
                            <label for="nasi_box" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Nasi Box</label>
                            <input type="text" id="nasi_box" value="{{ $peminjaman->nasi_box }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="snack" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Snack</label>
                            <input type="text" id="snack" value="{{ $peminjaman->snack }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>

                        <div class="mb-4">
                            <label for="waktu" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Waktu Mulai</label>
                            <input type="text" id="waktu_mulai" value="{{ Carbon\Carbon::parse($peminjaman->start_date)->format('H:i') }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="waktu" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Waktu Selesai</label>
                            <input type="text" id="waktu_selesai" value="{{ Carbon\Carbon::parse($peminjaman->end_date)->format('H:i') }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                    </div>
                    <div>
                        <div class="mb-4">
                            <label for="proyektor" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Proyektor</label>
                            <input type="text" id="proyektor" value="{{ $peminjaman->proyektor == 1 ? 'Ya' : 'Tidak' }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="vicon" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Video Conference</label>
                            <input type="text" id="vicon" value="{{ $peminjaman->vicon == 1 ? 'Ya' : 'Tidak' }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="prasmanan" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Prasmanan</label>
                            <input type="text" id="prasmanan" value="{{ $peminjaman->prasmanan }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah_peserta" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Jumlah Peserta</label>
                            <input type="text" id="jumlah_peserta" value="{{ $peminjaman->jumlah_peserta }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="acara" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Acara</label>
                    <textarea id="acara" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled rows="2">{{ $peminjaman->acara }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="konsumsi" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Pesanan Konsumsi</label>
                    <textarea id="konsumsi" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled rows="2">{{ $peminjaman->konsumsi }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="catatan" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Catatan</label>
                    <textarea id="catatan" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled rows="2">{{ $peminjaman->catatan }}</textarea>
                </div>
            </div>
        </div>
    </section>