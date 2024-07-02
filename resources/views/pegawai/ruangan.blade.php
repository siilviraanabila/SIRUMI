<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Meeting</title>
    @include('layouts.header')
</head>

<body style="background-color: #D3F0FF;">
    @include('layouts.sidebar')
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
            <form class="max-w-md mx-auto" method="GET" action="{{ route('search') }}">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Gedung, Ruangan, Kapasitas" required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>

            @foreach ($gedungWithRuangan as $itemGedung)
                <hr class="col-span-4 my-4 border-t border-gray-900">
                <h1 class="font-bold text-black text-3xl text-center mb-4 mt-3">{{ $itemGedung->nama_gedung }}</h1>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    @forelse ($itemGedung->ruangan as $ruangan)
                        <div class="col-span-4 md:col-span-2 lg:col-span-1 flex">
                            <div class="max-w-sm mx-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col">
                                <div class="text-center p-5 bg-white dark:bg-gray-800 rounded-lg">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-black">{{ $ruangan->nama_ruangan }}</h5>
                                </div>
                                <img src="{{ asset('foto ruangan/' . $ruangan->image) }}" alt="" class="card-img-top px-5 mx-auto" style="max-width: 300px; max-height: 200px; object-fit: cover;">
                                <div class="p-5 flex-grow">
                                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-400 flex-grow">
                                        @foreach(explode(';', $ruangan->description) as $descItem)
                                        <li>{{ $descItem }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @empty
                    <p>Tidak ada item yang ditemukan.</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </section>
</body>

</html>