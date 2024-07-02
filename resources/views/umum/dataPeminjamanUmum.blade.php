<title>Data Peminjaman</title>
@include('layouts.header')

<body style="background-color: #D3F0FF;"> 
    @include('layouts.sidebar')
    <section id="home" class="py-5" style="margin-left: 16rem;">
        <div class="col-span-4 text-center mb-10">
            <h5 class="font-bold text-gray-900" style="font-size: 24px;">Daftar Peminjaman</h5>
        </div>
        <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-400 list background-color: #179FB7;" style="table-layout: fixed;">
            <thead class="text-xs text-gray-400 uppercase bg-gray-300">
                <tr>
                    <th scope="col" class="rounded-tl-lg px-2 py-3 text-black" style="width: 50px; border-right: 1px solid #000;">
                        No
                    </th>
                    <!--<th scope="col" class="px-2 py-2 text-black" style="border-right: 1px solid #000;">
                        Nama Pegawai
                    </th>-->
                    <th scope="col" class="px-8 py-2 text-black" style="border-right: 1px solid #000; max-width: 80px; word-wrap: break-word;">
                        Acara
                    </th>
                    <th scope="col" class="px-7 py-2 text-black" style="border-right: 1px solid #000; max-width: 80px; word-wrap: break-word;">
                        Ruangan
                    </th>
                    <th scope="col" class="px-7 py-2 text-black" class="py-2 text-black" style="border-right: 1px solid #000; max-width: 100px; word-wrap: break-word;">
                        Tanggal
                    </th>
                    <th scope="col" class="px-8 py-2 text-black" style="border-right: 1px solid #000; max-width: 100px; word-wrap: break-word;">
                        Waktu
                    </th>
                    <th scope="col" class="rounded-tr-lg px-10 py-3 text-black">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjaman as $item)
                    <tr id="deleteForm{{ $item->peminjaman_id }}" class="list border-b bg-white border-gray-700 hover:bg-gray-60 hover:bg-gray-200"> 
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-black" style="border-right: 1px solid #000;">
                            {{ $loop->iteration }}
                        </th>
                        <!--<td class="px-4 py-2 nama-pegawai text-black" style="border-right: 1px solid #000;">
                            {{ $item->nama_lengkap }} -->
                        </td>
                        <td class=" px-4 py-2 acara text-black" style="border-right: 1px solid #000;"> <!-- Menyesuaikan lebar maksimum untuk kolom "Acara" -->
                            {{ $item->acara }}
                        </td>
                        <td class="px-4 py-2 nama-ruangan text-black" style="border-right: 1px solid #000;"> <!-- Menyesuaikan lebar maksimum untuk kolom "Ruangan" -->
                            {{ $item->nama_ruangan }}
                        </td>
                        <td class="px-4 py-2 tanggal text-black" style="border-right: 1px solid #000;"> <!-- Menyesuaikan lebar maksimum untuk kolom "Tanggal" -->
                            {{ $item->tanggal }}
                        </td>
                        <td class="px-4 py-2 waktu text-black" style="border-right: 1px solid #000;"> <!-- Menyesuaikan lebar maksimum untuk kolom "Waktu" -->
                            {{ Carbon\Carbon::parse($item->start_date)->format('H:i') }} - {{ Carbon\Carbon::parse($item->end_date)->format('H:i') }}
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('showdataPeminjamanUmum', ['id' => $item->peminjaman_id]) }}" class="text-violet-500">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('editdataPeminjamanUmum', ['id' => $item->peminjaman_id]) }}" class="text-cyan-500">
                                    <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>
                                <a href="javascript:void(0)" onclick="deletePeminjamanUmum('{{ $item->peminjaman_id }}')" class="text-red-500">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                    </svg>
                                </a>
                            </div>
                            <!-- <div class="flex justify-end mt-2">
                                <a href="javascript:void(0)" onclick="deletePeminjamanUmum('{{ $item->peminjaman_id }}')" class="text-red-500">
                                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                    </svg>
                                </a>
                            </div> -->
                        </td>
                    </tr>
                    @empty
                    <tr class="border-b bg-white border-gray-700 hover:bg-gray-60 hover:bg-gray-200">
                        <td class="py-2 px-4 border-b text-black text-center" colspan="6">Tidak ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });

            function deletePeminjamanUmum(id) {
                if (confirm('Anda yakin ingin menghapus peminjaman ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/umum/deletePeminjamanUmum/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success: function(response) {
                            console.log('Peminjaman berhasil dihapus');
                            // Mencari elemen dengan atribut peminjaman_id
                            $('#deleteForm' + id).closest('tr').remove();
                        },
                        error: function(error) {
                            console.log('Error:', error);
                            alert('Gagal menghapus peminjaman.');
                        }
                    });
                }
            }
        </script>           
    </section>
</body>
