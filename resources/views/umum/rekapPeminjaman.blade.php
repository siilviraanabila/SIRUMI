<title>Rekap Peminjaman</title>
@include('layouts.header')

<body style="background-color: #D3F0FF;"> 
    @include('layouts.sidebar')
    <section id="home" class="py-5" style="margin-left: 16rem;">
        <div class="col-span-4 text-center mb-4">
            <h5 class="font-bold text-gray-900" style="font-size: 24px;">Rekap Peminjaman</h5>
        </div>
        <div id="halaman" class="w-full h-fit p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="row">
                <div class="col-12">
                    <div class="flex justify-between "> <!-- Menggunakan flex dan justify-between untuk menyusun secara rapi -->       
                        <div class="flex items-center">
                            <a href="{{ route('export_excel')}}" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-800 dark:bg-white dark:border-gray-700 dark:text-gray-900 dark:hover:bg-gray-200 me-2 mb-2">Download</a> <!-- Gunakan kelas CSS baru untuk tombol "Download" -->
                            <a href="{{ route('cetakRekap')}}" target="_blank" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-800 dark:bg-white dark:border-gray-700 dark:text-gray-900 dark:hover:bg-gray-200 me-2 mb-2">Print</a> <!-- Gunakan kelas CSS baru untuk tombol "Print" -->
                        </div>
                    </div>
                    <table class="border-collapse w-full">
                        <thead class="text-black">
                            <tr>
                                <th class="text-center py-2 border border-black">No</th>
                                <th class="py-2 border border-black">NIP</th>
                                <th class="py-2 border border-black">Acara</th>
                                <th class="py-2 border border-black">Gedung</th>
                                <th class="text-center py-2 border border-black">Ruangan</th>
                                <th class="text-center py-2 border border-black">Jumlah Peserta</th>
                                <th class="py-2 border border-black">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjaman as $pinjam)
                            <tr>
                                <td class="text-center py-2 text-black border border-black">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="py-2 text-black border border-black text-center">
                                    {{ $pinjam->nip }}
                                </td>
                                <td class="py-2 text-black border border-black text-center" style="max-width: 200px; word-wrap: break-word;">
                                    {{ $pinjam->acara }}
                                </td>
                                <td class="py-2 text-black border border-black text-center">
                                    {{ $pinjam->nama_gedung}} <!-- Menggunakan relasi 'gedung' untuk mengakses nama gedung -->
                                </td>
                                <td class="text-center py-2 text-black border border-black">
                                    {{ $pinjam->nama_ruangan }} <!-- Menggunakan relasi 'ruangan' untuk mengakses nama ruangan -->
                                </td>
                                <td class="text-center py-2 text-black border border-black">
                                    {{ $pinjam->jumlah_peserta }}
                                </td>
                                <td class="py-2 text-black border border-black text-center">
                                    {{ $pinjam->tanggal }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-2 text-black border border-black">
                                    No data available
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>


