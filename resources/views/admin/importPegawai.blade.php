<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Impor Akun</title>
    @include('layouts.header')
</head>

<body style="background-color: #D3F0FF;">
    @include('layouts.sidebar')
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
            <div class="col-span-4 text-center mb-5">
                <h5 class="font-bold text-black" style="font-size: 30px;">Impor Akun</h5>
            </div>
            <a href="{{ route('downloadTemplate')}}" class="text-black font-medium rounded-lg text-l px-5 py-2.5 me-2 mb-2 border border-slate-300 hover:border-slate-400"  style="background-color: #FFF212; focus:ring-custom " type="submit">Download Template</a>
            <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">    
                <form method="POST" action="{{ route('importPegawai') }}" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @if(session('success'))
                    <div class="flex items-center p-4 mb-4 text-l text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                    @endif
                    <label class="block mb-2 text-l font-medium text-black" for="file">Upload file excel</label>
                    <input type="file" class="block w-full text-l text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" name="file"></input>
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-l px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit">Import</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
