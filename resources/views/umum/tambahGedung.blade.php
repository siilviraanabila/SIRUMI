<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gedung</title>
    @include('layouts.header')
</head>
<body style="background-color: #D3F0FF;"> 
    @include('layouts.sidebar')
    <section id="home" class="pt-5" style="margin-left: 16rem;">

        <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4" type="button">
        Tambah Gedung
        </button>

        <div class="grid grid-cols-3 gap-4">
            @foreach ($gedung as $item)
            <div id="deleteForm{{ $item->gedung_id }}" class="col-span-4 md:col-span-2 lg:col-span-1">
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="text-center p-5 bg-white dark:bg-gray-800 rounded-lg">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $item->nama_gedung }}</h5>
                    </div>
                    <img src="{{ asset('foto gedung/' . $item->gambar ) }}" alt="" class="card-img-top px-5 mx-auto" style="max-width: 300px; max-height: 200px;">
                    <div class="p-5 grid grid-cols-2 gap-3"> <!-- Menambahkan grid layout -->
                        <a href="{{ route('editGedung', ['id' => $item->gedung_id]) }}" class="focus:outline-none text-black text-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900" type="button">
                            Edit
                        </a>
                        <!-- Tambahkan aksi hapus -->
                        <a href="javascript:void(0)" onclick="deleteGedung('{{ $item->gedung_id }}')" class="focus:outline-none text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

            <!-- Main modal -->
            <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Tambah Gedung
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <form action="{{ route('storeTambahGedung') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_gedung" class="block mb-2 text-m font-medium text-gray-900 dark:text-white">Nama Gedung</label>
                                    <input type="text" id="nama_gedung" name="nama_gedung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div class="mb-3">           
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar">Gambar Gedung</label>
                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" name="gambar" id="gambar" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG or JPEG.</p>
                                </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button id="simpanButton" data-modal-hide="default-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script>
            // Fungsi untuk menampilkan modal konfirmasi hapus
            function deleteGedung(id) {
                if (confirm('Anda yakin ingin menghapus gedung ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/umum/deleteGedung/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success: function(response) {
                            console.log('Gedung berhasil dihapus');
          
                            $('#deleteForm' + id).remove();
                        },
                        error: function(error) {
                            console.log('Error:', error);
                            alert('Gagal menghapus gedung.');
                        }
                    });
                }
            }
        </script>
</body>

