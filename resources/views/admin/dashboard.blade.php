<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @include('layouts.header')
</head>
<body style="background-color: #D3F0FF;"> 
    @include('layouts.sidebar')
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
        <div class="col-span-4 text-center mb-4">
                <h1 class="font-bold text-black" style="font-size: 35px;">Selamat Datang</h1>
                <h5 class="text-black" style="font-size: 20px;">di Sistem Informasi Reservasi Ruang Meeting Sebagai User Pegawai dan Admin 
                <!-- <p>PT PLN Indonesia Power UBP Semarang</p></h5> -->
            </div>

            <hr class="col-span-4 my-4 border-t border-gray-900">

            <div class="grid grid-cols-4 gap-4">
                <a href="{{ route('geteventAdmin') }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 ">
                    <img src="/img/12.png" alt="" class="w-full max-w-xs mx-auto px-5" style="max-height: 200px;">
                    <div class="p-4 h-full leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Jadwal Meeting</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            Admin dapat melihat jadwal meeting yang sudah terisi pada tanggal beserta jam mulai - jam selesai.
                        </p>
                    </div>
                </a>
                <a href="{{ route('importPegawai') }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img src="/img/10.png" alt="" class="w-full max-w-xs mx-auto px-5" style="max-height: 200px;">
                    <div class="p-4 h-full leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Import Akun</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            Admin dapat impor akun secara otomatis menggunakan upload excel.
                        </p>
                    </div>

                </a>
                <a href="{{ route('registerPegawai') }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img src="/img/11.png" alt="" class="w-full max-w-xs mx-auto px-5" style="max-height: 200px;">
                    <div class="p-4 h-full leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Register Akun</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Admin dapat membuat akun dengan mengisi formulir.</p>
                    </div>
                </a>
                <a href="{{ route('getDaftarPegawai') }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img src="/img/9.png" alt="" class="w-full max-w-xs mx-auto px-5" style="max-height: 200px;">
                    <div class="p-4 h-full leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Manejemen Data Akun</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Admin dapat melihat, mengedit, menghapus akun Pegawai.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

</body>

</html>