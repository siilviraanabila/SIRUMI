<title>Dashboard Pegawai</title>
@include('layouts.header')
    <!-- Hero Section Start -->
<body style="background-color: #D3F0FF;"> 
    @include('layouts.sidebar')
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
            <div class="col-span-4 text-center mb-4">
                <h1 class="font-bold text-black" style="font-size: 35px;">Selamat Datang</h1>
                <h5 class="text-black" style="font-size: 20px;">di Sistem Informasi Reservasi Ruang Meeting Sebagai User Pegawai dan Admin 
                <!-- <p>PT PLN Indonesia Power UBP Semarang</p></h5> -->
            </div>

            <hr class="col-span-4 my-4 border-t border-gray-900">

            <div class="col-span-4 text-center mb-4">
                <h5 class="font-bold text-black" style="font-size: 24px;">Gedung</h5>
            </div>

            <div class="grid grid-cols-3 gap-4">
                @foreach ($gedung as $item)
                <div id="deleteForm{{ $item->gedung_id }}" class="col-span-4 md:col-span-2 lg:col-span-1">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="text-center p-5 bg-white dark:bg-gray-800 rounded-lg">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $item->nama_gedung }}</h5>
                        </div>
                        <img src="{{ asset('foto gedung/' . $item->gambar ) }}" alt="" class="card-img-top px-5 mx-auto" style="max-width: 300px; max-height: 200px;">
                    </div>
                </div>
                @endforeach
            </div>

            <hr class="col-span-4 my-4 border-t border-gray-900">

            <div class="col-span-4 text-center mb-4">
                <h5 class="font-bold text-black" style="font-size: 24px;">Fasilitas</h5>
            </div>

            <div class="grid grid-cols-3 gap-4">
                @foreach ($fasilitas as $fasilitas)
                <div id="deleteForm{{ $fasilitas->fasilitas_id }}" class="col-span-4 md:col-span-2 lg:col-span-1">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="text-center p-5 bg-white dark:bg-gray-800 rounded-lg">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $fasilitas->nama_fasilitas }}</h5>
                        </div>
                        <img src="{{ asset('foto fasilitas/' . $fasilitas->picture ) }}" alt="" class="card-img-top px-5 mx-auto" style="max-width: 300px; max-height: 200px;">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</body>
</html>