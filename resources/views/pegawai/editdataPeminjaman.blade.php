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
    @include('layouts.sidebar')
    <section id="home" class="py-5">
        <div style="margin-left: 16rem;">
            <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between p-1 text-gray-900 dark:text-white">
                    <a href="{{ route('getDataPeminjaman') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-l px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Back
                    </a>
                </div>
                <div class="mb-4">
                    <h4 class="text-lg font-bold text-black dark:text-light text-center w-full" style="font-size: 25px;">Edit Data Peminjaman</h4>
                </div>
                @livewire('multi-step-edit-peminjaman', ['id' => $peminjaman->peminjaman_id])
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
                </script>
            </div>
        </div>
    </section>
</body>
</html>