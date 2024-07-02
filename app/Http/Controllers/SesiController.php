<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }
    function admin()
    {
        if (auth()->check()) {
        // Jika pengguna sudah masuk, arahkan mereka ke halaman yang sesuai dengan rolenya
        switch (auth()->user()->role) {
            case 'pegawai':
                return redirect('/pegawai/dashboard');
            case 'admin':
                return redirect('/admin/dashboard');
            case 'umum':
                return redirect('/umum/dashboardUmum');
            default:
                return redirect('/logout');
        }
    }
    return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'credential' => 'required',
            'password' => 'required',
        ], [
            'credential.required' => 'Email/NIP wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->credential,
            'password' => $request->password,
        ];

        $emailExists = isset($infologin['email']) ? User::where('email', $infologin['email'])->exists() : false;

        if (!$emailExists) {
            return redirect()->back()->withErrors('Email belum terdaftar')->withInput();
        }

        if (Auth::attempt($infologin)) {
            $user = Auth::user();

            // Setelah melakukan pengecekan, lanjutkan dengan rute sesuai peran
            if ($user->role == 'pegawai') {
                return redirect('/');
            } elseif ($user->role == 'umum') {
                return redirect('/');
            } elseif ($user->role == 'admin') {
                return redirect('/');
            }
        } else {
            return redirect()->back()->withErrors('Email/NIP dan Password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }

    function dashboard()
    {
        return view('dashboard');
    }
}
