<title>Edit Gedung</title>
@include('layouts.header')

<body style="background-color: #D3F0FF;"> 
    <section id="home" class="pt-28">
    <div class="flex justify-between p-4">
        <div class="text-left">
            <button type="button" class="text-white bg-black hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-900 dark:hover:bg-gray-600 focus:outline-none dark:focus:ring-gray-900">
                <a href="{{ route('tambahGedung') }}">
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
        <form method="POST" action="{{ route('updateGedung', ['id' => $gedung->gedung_id]) }}" id="updateForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center justify-between p-4 border-b dark:border-primary text-gray-900 dark:text-white">
                <h4 class="text-lg font-bold text-black dark:text-light text-center w-full" style="font-size: 24px;">Edit Gedung</h4>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <div class="mb-3">
                    <label for="nama_gedung" class="block mb-2 text-m font-medium text-gray-900 dark:text-white">Nama Gedung</label>
                    <input type="text" id="nama_gedung" name="nama_gedung" value="{{ $gedung->nama_gedung }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-3">           
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar">Gambar Ruangan</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" name="gambar" id="gambar" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG or JPEG.</p>
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
            
            function updateGedung(id) {
                if (confirm('Anda yakin ingin memperbarui data ini?')) {
                    // Gantilah URL dan data sesuai dengan kebutuhan Anda
                    $.ajax({
                        type: 'PUT',  // Metode HTTP untuk pembaruan
                        url: '/umum/updateGedung/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            // Tambahkan data pembaruan jika diperlukan
                        },
                        success: function(response) {
                            console.log('Gedung berhasil diperbarui');
                            // Lakukan tindakan lain jika diperlukan
                        },
                        error: function(error) {
                            console.log('Error:', error);
                            alert('Gagal memperbarui Gedung.');
                        }
                    });
                }
            }
        </script>
    </div>
</body>