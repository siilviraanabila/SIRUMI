<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Akun</title>
    @include('layouts.header')
</head>

<body style="background-color: #D3F0FF;">
    @include('layouts.sidebar')
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
            <div class="col-span-4 text-center mb-5">
                <h5 class="font-bold text-black" style="font-size: 30px;">Register Akun</h5>
            </div>
            <div id="halaman" class="mx-auto max-w p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">    
                <form method="POST" action="{{ route('registerPegawai') }}" id="registrationForm" class="max-w mx-auto grid grid-cols-2 gap-4">
                    @csrf
                    <div class="col-span-1">
                        <div class="mb-5">   
                            <label for="nip" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">NIP</label>
                            <input type="text" id="nip" name="nip" value="{{ old('nip') }}"  class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('nip')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">   
                            <label for="nama_lengkap" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"  class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">   
                            <label for="role" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Role</label>
                            <select id="role" name="role" value="{{ old('role') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="pegawai" {{ isset($user['role']) && $user['role'] === 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                                <option value="umum" {{ isset($user['role']) && $user['role'] === 'umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">   
                            <label for="id_bidang" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Bidang</label>
                            <select id="id_bidang" name="id_bidang" value="{{ old('id_bidang') }}"class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($bidangs as $id_bidang => $nama_bidang)
                                    <option value="{{ $id_bidang }}">{{ $nama_bidang }}</option>
                                @endforeach
                            </select>
                            @error('id_bidang')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Email address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="bambang@mail.com" required>
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div> 
                        <div class="mb-6">
                            <label for="password" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" name="password" value="{{ old('password') }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                            @error('password')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div> 
                        <div class="mb-6">
                            <label for="confirm_password" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input type="password" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
                            @error('confirm_password')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>    
                        <div class="flex justify-end mt-2 mb-2"> <!-- Flex untuk posisi tengah -->
                            <button type="submit" id="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-l px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
