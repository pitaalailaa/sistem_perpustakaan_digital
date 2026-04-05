<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // halaman login
    public function login()
    {
        return view('auth.login');
    }

    // proses login
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('kepala.dashboard');
            }
            if (auth()->user()->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // halaman register
    public function register()
    {
        return view('auth.register');
    }

    // proses register
    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'kelas' => 'nullable|string|max:50',
            'no_telp' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
            'role' => 'anggota'
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan login');
    }

    public function biodata()
    {
        return view('page.anggota.biodata');
    }
}
