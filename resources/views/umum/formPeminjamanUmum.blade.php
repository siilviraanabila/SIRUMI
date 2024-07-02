<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Peminjaman</title>
    @include('layouts.header')
    <style>
        .form-section{
            display: none;
        }

        .form-section.current{
            display: inline;
        }
        .parsley-errors-list{
            color:red;
        }

        .nav-link {
            border-radius: 10px; 
            padding: 6px; 
            background-color: #ffffff;
        }
        .c-stepper {
        counter-reset: stepCounter; 
        display: flex;
        justify-content: space-between;
        list-style: none;
        padding: 0;
        margin: 0 auto;
        max-width: 600px; 
        }

        .c-stepper__item {
        position: relative;
        text-align: center;
        width: 100%;
        }

        .c-stepper__item:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 15px;
        left: calc(50% + 20px); /* Sesuaikan jarak garis */
        right: -50%;
        height: 2px;
        background-color: #e0e0e0;
        z-index: -1;
        }

        .c-stepper__item::before {
        counter-increment: stepCounter; 
        content: counter(stepCounter); 
        width: 30px;
        height: 30px;
        line-height: 30px;
        border: 2px solid #000;
        display: block;
        text-align: center;
        margin: 0 auto;
        border-radius: 50%;
        background-color: #fff;
        position: relative;
        z-index: 1;
        }
        /* Adjust this to change the spacing */
        .c-stepper__title {
            margin-top: 8px;
        }
    </style>
    @livewireStyles
</head>
<body style="background-color: #D3F0FF;"> 
    @livewireScripts
    @include('layouts.sidebar')
    <section id="home" class="py-5">
        <div style="margin-left: 16rem;">
            <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="mb-4">
                    <h4 class="text-lg font-bold text-black dark:text-light text-center w-full" style="font-size: 25px;">Formulir Peminjaman</h4>
                </div>
                    @livewire('multi-step-form-peminjaman-umum')
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