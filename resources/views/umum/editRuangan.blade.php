<title>Edit Ruang</title>
@include('layouts.header')

<body style="background-color: #D3F0FF;"> 
    <section id="home" class="pt-28">
    <div class="flex justify-between p-4">
        <div class="text-left">
            <button type="button" class="text-white bg-black hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none dark:focus:ring-gray-900">
                <a href="{{ route('tambahRuangan') }}">
                    <div class="flex flex-row align-middle">
                        <svg class="w-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="ml-2">Prev</p>
                    </div>
                </a>
            </button>
        </div>
    </div>
    </section>
    <div id="halaman" class="w-full h-fit p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="POST" action="{{ route('updateRuangan', ['id' => $ruangan->ruangan_id]) }}" id="updateForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center justify-between p-4 border-b dark:border-primary text-gray-900 dark:text-white">
                <h4 class="text-lg font-bold text-black dark:text-light text-center w-full" style="font-size: 24px;">Edit Ruangan</h4>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <div class="mb-3">
                    <label for="gedung" class="block mb-2 text-m font-medium text-gray-900 dark:text-white">Nama Gedung</label>
                    <select name="gedung" id="gedung" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($gedung as $itemGedung)
                        <option value="{{ $itemGedung->gedung_id}}" {{ $itemGedung->gedung_id == $ruangan->id_gedung ? 'selected' : '' }}>{{$itemGedung->nama_gedung}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama_ruangan" class="block mb-2 text-m font-medium text-gray-900 dark:text-white">Nama Ruangan</label>
                    <input type="text" id="nama_ruangan" name="nama_ruangan" value="{{ $ruangan->nama_ruangan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="block mb-2 text-m font-medium text-gray-900 dark:text-white">Kapasitas</label>
                    <input type="text" id="kapasitas" name="kapasitas" value="{{ $ruangan->kapasitas }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-3">           
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Gambar Ruangan</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" name="image" id="image" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG or JPEG.</p>
                </div>
                <div class="mb-3">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detail Ruangan</label>
                    <textarea id="description" name="description" rows="4" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $ruangan->description }}</textarea>
                </div>
            </div>
            <div class="text-center p-4">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Update
                </button>
            </div>
        </form>
        <script>
            document.getElementById('updateForm').addEventListener('submit', function (event) {
                if (!confirm('Anda yakin ingin memperbarui data ini?')) {
                    event.preventDefault();
                }
            });
            
            function updateRuangan(id) {
                if (confirm('Anda yakin ingin memperbarui data ini?')) {
                    // Gantilah URL dan data sesuai dengan kebutuhan Anda
                    $.ajax({
                        type: 'PUT',  // Metode HTTP untuk pembaruan
                        url: '/umum/updateRuangan/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            // Tambahkan data pembaruan jika diperlukan
                        },
                        success: function(response) {
                            console.log('Ruangan berhasil diperbarui');
                            // Lakukan tindakan lain jika diperlukan
                        },
                        error: function(error) {
                            console.log('Error:', error);
                            alert('Gagal memperbarui konsumsi.');
                        }
                    });
                }
            }
        </script>
    </div>
</body>