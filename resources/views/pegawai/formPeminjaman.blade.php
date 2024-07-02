<!DOCTYPE html>
<html lang="id">
<head>
    <title>Formulir Peminjaman</title>
    @include('layouts.header')
    @livewireStyles
</head>
<body class="overflow-hidden" style="background-color: #D3F0FF;">
    @include('layouts.sidebar')
    @livewireScripts
    <section id="home" class="py-5">
        <div style="margin-left: 16rem;">
            <div id="halaman" class="p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="mb-4">
                    <h4 class="text-lg font-bold text-black dark:text-black text-center w-full" style="font-size: 25px;">Formulir Peminjaman</h4>
                </div>
                    @livewire('multi-step-form-peminjaman')
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#gedung_id').on('change', function() {
                var gedungId = $(this).val();
                var selectedRuangan = $('#ruangan_id').val();
                if (gedungId) {
                    $.ajax({
                        url: '/get-ruangan-gedung',
                        type: 'GET',
                        data: {gedung_id: gedungId},
                        dataType: 'json',
                        success: function(data) {
                            $('#ruangan_id').empty();
                            $.each(data, function(key, value) {
                                $('#ruangan_id').append('<option value="' + value.ruangan_id + '">' + value.nama_ruangan + ' (kapasitas: ' + value.kapasitas + ')' + '</option>');
                            });
                            if(selectedRuangan) {
                                $('#ruangan_id').val(selectedRuangan);
                            }
                        }
                    });
                } else {
                    $('#ruangan_id').empty();
                }
            });
            $('#nasi-box-checkbox').change(function(){
                if(this.checked) {
                    $('#nasi-box-input').show();
                } else {
                    $('#nasi-box-input').hide();
                }
            });
            $('#snack-checkbox').change(function(){
                if(this.checked) {
                    $('#snack-input').show();
                } else {
                    $('#snack-input').hide();
                }
            });
            $('#prasmanan-checkbox').change(function(){
                if(this.checked) {
                    $('#prasmanan-input').show();
                } else {
                    $('#prasmanan-input').hide();
                }
            });
        });
    </script>
</body>
</html>
