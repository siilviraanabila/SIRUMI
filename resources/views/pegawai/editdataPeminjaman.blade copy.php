<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit Data Peminjaman</title>
    @include('layouts.header')
    @livewireStyles
</head>

<body style="background-color: #D3F0FF;"> 
@livewireScripts
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-900">
            <a href="#" class="flex items-center ps-2.5 mb-5">
                <img src="/img/logo.png" class="h-10 me-3 sm:h-10" alt="logo" />
            </a>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboardPegawai') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('geteventPegawai') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z"/>
                        </svg>
                        <span class="ms-3">Jadwal Meeting</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ruangan') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="ms-3">Ruang Meeting</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('formPeminjaman') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                            <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                            <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                        </svg>
                        <span class="ms-3">Formulir Peminjaman</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('getDataPeminjaman') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z"/>
                        </svg>
                        <span class="ms-3">Data Peminjaman</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                    </a>
                </li>
            </ul>
            
        </div>
    </aside>
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
            <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between p-1 border-b dark:border-primary text-gray-900 dark:text-white">
                    <a href="{{ route('getDataPeminjaman') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-l px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Back
                    </a>
                    <h4 class="text-lg font-bold text-black dark:text-light text-center w-full" style="font-size: 25px;">Edit Data Peminjaman</h4>
                </div>
                <form method="POST" action="{{ route('updatePeminjaman', ['id' => $peminjaman->peminjaman_id]) }}" id="updateForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-3 gap-4">
                        <!-- Kolom Kiri -->
                        <div>
                            <div class="mb-4">
                                <label for="nama_lengkap" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Nama Peminjam</label>
                                <input name="nama_lengkap" id="nama_lengkap" value="{{ $peminjaman->nama_lengkap }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                            </div>
                            <div class="mb-4">
                                <label for="tanggal" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Tanggal</label>
                                <input name="tanggal" id="tanggal" value="{{ Carbon\Carbon::parse($peminjaman->tanggal)->format('Y-m-d') }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('tanggal')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="gedung" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Gedung</label>
                                <select name="gedung_id" id="gedung_id" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled>--Pilih Gedung--</option>
                                    @foreach($gedung as $item)
                                    <option value="{{ $item->gedung_id }}" {{ $item->gedung_id == $peminjaman->gedung ? 'selected' : '' }}>{{ $item->nama_gedung }}</option>
                                    @endforeach
                                </select>
                                @error('gedung')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="ruangan" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Ruangan</label>
                                <select name="ruangan_id" id="ruangan_id" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" disabled selected>--Pilih Ruangan--</option> <!-- Default option -->
                                    @foreach($ruangan as $item)
                                    <option value="{{ $item->ruangan_id }}" data-nama-ruangan="{{ $item->nama_ruangan }}" {{ $item->ruangan_id == $peminjaman->ruangan_id ? 'selected' : '' }}>{{ $item->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                                @error('ruangan')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror

                                <input type="hidden" name="nama_ruangan" id="nama_ruangan" value="{{ $peminjaman->nama_ruangan }}">
                            </div>
                            <div class="mb-4">
                                <label for="acara" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Acara</label>
                                <input name="acara" id="acara" value="{{ $peminjaman->acara }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('acara')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label for="nasi_box" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Nasi Box</label>
                                <input name="nasi_box" id="nasi_box" value="{{ $peminjaman->nasi_box }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('nasi_box')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="snack" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Snack</label>
                                <input name="snack" id="snack" value="{{ $peminjaman->snack }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('snack')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="waktu_mulai" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Waktu Mulai</label>
                                <input type="time" name="waktu_mulai" id="waktu_mulai" value="{{ Carbon\Carbon::parse($peminjaman->start_date)->format('H:i') }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('waktu_mulai')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="waktu_selesai" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Waktu Selesai</label>
                                <input type="time" name="waktu_selesai" id="waktu_selesai" value="{{ Carbon\Carbon::parse($peminjaman->end_date)->format('H:i') }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('waktu_selesai')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="konsumsi" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Pesanan Konsumsi</label>
                                <input name="konsumsi" id="konsumsi" value="{{ $peminjaman->konsumsi }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('konsumsi')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label for="proyektor" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Proyektor</label>
                                <select name="proyektor" id="proyektor" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="Ya" {{ $peminjaman->proyektor == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ $peminjaman->proyektor == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('proyektor')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="vicon" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Video Conference</label>
                                <select name="vicon" id="vicon" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="Ya" {{ $peminjaman->vicon == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ $peminjaman->vicon == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('vicon')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="prasmanan" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Prasmanan</label>
                                <input name="prasmanan" id="prasmanan" value="{{ $peminjaman->prasmanan }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('prasmanan')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="jumlah_peserta" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Jumlah Peserta</label>
                                <input name="jumlah_peserta" id="jumlah_peserta" value="{{ $peminjaman->jumlah_peserta }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('jumlah_peserta')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="catatan" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Catatan</label>
                                <input type="text" id="catatan" value="{{ $peminjaman->catatan }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled >
                                @error('catatan')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-3 flex justify-end">
                            <!-- Tombol Submit -->
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-l px-5 py-2.5 me-1 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Update
                            </button>
                        </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $('#gedung_id').on('change', function() {
                            var gedungId = $(this).val();
                            if (gedungId) {
                                $.ajax({
                                    url: '/get-ruangan-gedung',
                                    type: 'GET',
                                    data: {
                                        gedung_id: gedungId
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#ruangan_id').empty();
                                        $.each(data, function(key, value) {
                                            $('#ruangan_id').append('<option value="' + value.ruangan_id + '">' + value.nama_ruangan + '</option>');
                                        });
                                    }
                                });
                            } else {
                                $('#ruangan_id').empty();
                            }
                        });
                    });

                    document.getElementById('updateForm').addEventListener('submit', function (event) {
                        if (!confirm('Anda yakin ingin memperbarui peminjaman ini?')) {
                            event.preventDefault();
                        }
                    });

                    document.addEventListener("DOMContentLoaded", function() {
                        var waktuMulaiInput = document.getElementById('waktu_mulai');
                        var waktuSelesaiInput = document.getElementById('waktu_selesai');

                        waktuMulaiInput.addEventListener('change', function() {
                            // Validasi hanya jika waktu selesai tidak kosong
                            if (waktuSelesaiInput.value && new Date(waktuMulaiInput.value) >= new Date(waktuSelesaiInput.value)) {
                                alert('Waktu mulai harus lebih awal dari waktu selesai.');
                                waktuMulaiInput.value = ''; // Kosongkan nilai waktu mulai
                            }
                        });

                        waktuSelesaiInput.addEventListener('change', function() {
                            // Validasi hanya jika waktu mulai tidak kosong
                            if (waktuMulaiInput.value && new Date(waktuMulaiInput.value) >= new Date(waktuSelesaiInput.value)) {
                                alert('Waktu selesai harus lebih lambat dari waktu mulai.');
                                waktuSelesaiInput.value = ''; // Kosongkan nilai waktu selesai
                            }
                        });
                    });
                    
                    function updatePeminjaman(id) {
                        if (confirm('Anda yakin ingin memperbarui peminjaman ini?')) {
                            // Gantilah URL dan data sesuai dengan kebutuhan Anda
                            $.ajax({
                                type: 'PUT',  // Metode HTTP untuk pembaruan
                                url: '/pegawai/updatePeminjaman/' + id,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    // Tambahkan data pembaruan jika diperlukan
                                },
                                success: function(response) {
                                    console.log('Peminjaman berhasil diperbarui');
                                    // Lakukan tindakan lain jika diperlukan
                                },
                                error: function(error) {
                                    console.log('Error:', error);
                                    alert('Gagal memperbarui peminjaman.');
                                }
                            });
                        }
                    }
                </script>
            </div>
        </div>
    </section>
</body>
</html>