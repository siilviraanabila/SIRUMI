<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Akun</title>
    @include('layouts.header')
</head>

<body style="background-color:#D3F0FF;">
    @include('layouts.sidebar')
    <section id="home" class="pt-5">
        <div style="margin-left: 16rem;">
            <div id="halaman" class="mx-auto max-w p-2 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between p-4 border-b dark:border-primary text-gray-900 dark:text-white">
                    <a href="{{ route('getDaftarPegawai') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-l px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Back
                    </a>
                    <h4 class="text-lg font-bold text-black dark:text-light text-center w-full" style="font-size: 25px;">Edit Data Akun</h4>
                </div>
                <form method="POST" action="{{ route('updatePegawai', ['nip' => $pegawai->nip]) }}" id="updateForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <div class="mb-5">
                                <label for="nip" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">NIP</label>
                                <input type="text" id="nip" name="nip" value="{{ $pegawai->nip }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('nip')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="nama_lengkap" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ $pegawai->nama_lengkap }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="role" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Role</label>
                                <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="pegawai" {{ isset($user->role) && $user->role === 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                                    <option value="umum" {{ isset($user->role) && $user->role === 'umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="admin" {{ isset($user->role) && $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="id_bidang" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Bidang</label>
                                <select id="id_bidang" name="id_bidang" class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($bidangs as $id_bidang => $nama_bidang)
                                        <option value="{{ $id_bidang }}" {{ $pegawai->id_bidang == $id_bidang ? 'selected' : '' }}>{{ $nama_bidang }}</option>
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
                                <input type="email" id="email" name="email" value="{{ $user->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="bambang@mail.com" required>
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="password" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" id="password" name="password" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                                @error('password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="confirm_password" class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-l rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                                @error('confirm_password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end mt-2 mb-2">
                                <button type="submit" id="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-l px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                            </div>
                        </div>
                    </div>
                </form>  
                <script>

                    document.getElementById('updateForm').addEventListener('submit', function (event) {
                        if (!confirm('Anda yakin ingin memperbarui pegawai ini?')) {
                            event.preventDefault();
                        }
                    });
                    
                    function updatePegawai(nip) {
                        if (confirm('Anda yakin ingin memperbarui pegawai ini?')) {
                            // Prevent default form submission
                            event.preventDefault();

                            // Gather form data
                            var formData = $('#updateForm').serialize();

                            // Send AJAX request
                            $.ajax({
                                type: 'PUT',
                                url: '/admin/updatePegawai/' + nip,
                                data: formData,
                                success: function (response) {
                                    console.log('Data Pegawai berhasil diperbarui');
                                    // Perform any additional actions if needed
                                },
                                error: function (error) {
                                    console.log('Error:', error);
                                    alert('Gagal memperbarui data pegawai.');
                                }
                            });
                        }
                    }
                </script>
            </div>
        </div>
    </section>
</body>
</html>