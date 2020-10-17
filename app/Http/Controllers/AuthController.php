<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $this->validate($request, [
        //     'username'           => 'required|',
        //     'password'           => 'required|confirmed',
        // ]);
        if (Auth::attempt($request->only('username', 'password'))) {
            if (Auth::guard('admin') && Auth::user()->level == 'admin') {
                return redirect('/admin');
            } else if (Auth::guard('siswa') && Auth::user()->level == 'siswa') {
                return redirect('/siswa');
            } else if (Auth::guard('walikelas') && Auth::user()->level == 'walikelas') {
                return redirect('/walikelas');
            }
        }
        return redirect('/')->with(['error' => 'username atau password anda salah!']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
