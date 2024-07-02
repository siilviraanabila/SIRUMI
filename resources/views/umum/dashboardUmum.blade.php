<title>Dashboard Umum</title>
@include('layouts.header')
<body style="background-color: #D3F0FF;"> 
    @include('layouts.sidebar')
    <section id="home" class="pt-5" style="margin-left: 16rem;">
        <div class="flex justify-between mb-4">
            <div class="w-full h-fit">
                <div class="col-span-4 text-center mb-4">
                    <h1 class="font-bold text-black" style="font-size: 35px;">Selamat Datang</h1>
                    <h5 class="text-black" style="font-size: 20px;">di Sistem Informasi Booking Ruang Meeting Sebagai User Umum 
                    <p>PT PLN Indonesia Power UBP Semarang</p></h5>
                </div>

                <hr class="col-span-4 my-4 border-t border-gray-100">
                
                <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="flex flex-col justify-between p-4 leading-normal w-full">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Catatan Acara</h5>
                        <table class="border-collapse w-full" style="font-size: 14px;">
                            <thead class="text-black">
                                <tr>
                                    <th class="text-center py-2 border border-black">No</th>
                                    <th class="py-2 border border-black">Tanggal</th>
                                    <th class="py-2 border border-black">Jam</th>
                                    <th class="py-2 border border-black">Acara</th>
                                    <th class="text-center py-2 border border-black">Ruangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($peminjaman as $pinjam)
                                @if ($peminjaman->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center py-2 text-black border border-white">
                                            Tidak ada peminjaman
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="text-center py-2 text-black border border-black">
                                            {{$loop->iteration }}
                                        </td>
                                        <td class="py-2 text-black border border-black text-center">
                                            {{ $pinjam->tanggal }}
                                        </td>
                                        <td class="py-2 text-black border border-black text-center">
                                            {{ Carbon\Carbon::parse($pinjam->start_date)->format('H:i') }} - {{ Carbon\Carbon::parse($pinjam->end_date)->format('H:i') }} 
                                        </td>
                                        <td class="py-2 text-black border border-black text-center" style="max-width: 200px; word-wrap: break-word;">
                                            {{ $pinjam->acara }}
                                        </td>
                                        <td class="text-center py-2 text-black border border-black">
                                            {{$pinjam->nama_ruangan }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between">
            @foreach ($peminjamanByGedungDanRuangan as $gedung => $ruanganPeminjaman)
                <div style="width: 48%;">
                    <h5 class="font-bold text-gray-900 text-xl text-center">{{ $gedung }}</h5>
                    @foreach ($ruanganPeminjaman as $ruangan => $peminjamans)
                        <div id="halaman" class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 max-w-4xl mx-auto">
                            <h5 class="font-bold text-black" style="font-size: 20px;">{{ $ruangan }}</h5>
                            <table class="border-collapse w-full" style="font-size: 12px;">
                                <thead class="text-black">
                                    <tr>
                                        <th class="text-center py-2 border border-black">No</th>
                                        <th class="py-2 border border-black">Tanggal</th>
                                        <th class="py-2 border border-black">Jam</th>
                                        <th class="py-2 border border-black">Acara</th>
                                        <!--<th class="text-center py-2 border border-black">PIC</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($peminjamans->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center py-2 text-black border border-black">
                                            Tidak ada peminjaman
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($peminjamans as $pinjam)
                                        <tr>
                                            <td class="text-center py-2 text-black border border-black">
                                                {{$loop->iteration }}
                                            </td>
                                            <td class="py-2 text-black border border-black text-center">
                                                {{ $pinjam->tanggal }}
                                            </td>
                                            <td class="py-2 text-black border border-black text-center">
                                                {{ Carbon\Carbon::parse($pinjam->start_date)->format('H:i') }} - {{ Carbon\Carbon::parse($pinjam->end_date)->format('H:i') }} 
                                            </td>
                                            <td class="py-2 text-black border border-black text-center">
                                                {{ $pinjam->acara }}
                                            </td>
                                            <!--<td class="text-center py-2 text-black border border-black">
                                                {{ $pinjam->nama_lengkap }}-->
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
</body>
</html>