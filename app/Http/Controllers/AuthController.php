<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cek user dengan approval tidak null & 0/1
        $user = User::where('email', $request->email)
            ->whereNotNull('approval')
            ->whereIn('approval', [0,1])
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Akun tidak valid / belum disetujui'
            ]);
        }

        // login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect('/employees');
        }

        return back()->withErrors([
            'password' => 'Password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}