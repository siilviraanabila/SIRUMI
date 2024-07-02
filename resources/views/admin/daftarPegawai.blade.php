<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manajemen Data Akun</title>
    @include('layouts.header')
</head>

<body style="background-color: #D3F0FF;">
    @include('layouts.sidebar')
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
            <div class="col-span-4 text-center mb-5">
                <h5 class="font-bold text-black" style="font-size: 30px;">Manajemen Data Akun</h5>
            </div>
            <table id="myTable" class="w-full text-l text-left rtl:text-right text-gray-400 list">
                <thead class="text-xs text-gray-400 uppercase bg-gray-300">
                    <tr>
                        <th scope="col" class="rounded-tl-lg px-5 py-3 text-black" style="width: 50px; border-right: 1px solid #000;">
                            No
                        </th>
                        <th scope="col" scope="col" class="px-7 py-2 text-black" style="border-right: 1px solid #000;">
                            Nama Pegawai
                        </th>
                        <th scope="col" class="px-7 py-2 text-black" style="border-right: 1px solid #000; max-width: 80px; word-wrap: break-word;">
                            NIP
                        </th>
                        <th scope="col" class="px-7 py-2 text-black" style="border-right: 1px solid #000; max-width: 80px; word-wrap: break-word;">
                            Role
                        </th>
                        <th scope="col" class="rounded-tr-lg px-9 py-3 text-center text-black">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawai as $pegawai)
                    <tr id="deleteForm{{ $pegawai->nip }}"  class="list border-b bg-white border-gray-700 hover:bg-gray-60 hover:bg-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-black" style="border-right: 1px solid #000;">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-2 nama-pegawai text-black" style="border-right: 1px solid #000;">
                            {{ $pegawai->nama_lengkap }}
                        </td>
                        <td class="px-6 py-4 nip text-black" style="border-right: 1px solid #000;">
                            {{ $pegawai->nip }}
                        </td>
                        <td class="px-4 py-4 role text-black" style="border-right: 1px solid #000;"">
                            {{ $pegawai->role }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('editPegawai', ['nip' => $pegawai->nip]) }}" class="text-cyan-500">
                                    <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>
                                <a href="javascript:void(0)" onclick="deletePegawai('{{ $pegawai->nip }}')" class="text-red-500">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="border-b bg-gray-800 border-gray-700 hover:bg-gray-50 hover:bg-gray-600">
                        <td class="py-2 px-4 border-b" colspan="6">Tidak ada data pegawai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable(); // Gantilah 'example' dengan ID tabel Anda.
                });
                function deletePegawai(nip) {
                    if (confirm('Anda yakin ingin menghapus pegawai ini?')) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/admin/deletePegawai/' + nip,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "DELETE"
                            },
                            success: function(response) {
                                console.log('Akun pegawai berhasil dihapus');
                                $('#deleteForm' + nip).closest('tr').remove();
                            },
                            error: function(error) {
                                console.log('Error:', error);
                                alert('Gagal menghapus pegawai.');
                            }
                        });
                    }
                }
            </script>
        </div>
    </section>

            