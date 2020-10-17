<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function datasiswa()
    {
        if (Auth::user()->level == 'walikelas') {
            $siswa = Siswa::where('kelas_id', Auth::user()->kelas_id)->get();
            return view('admin.datasiswa', compact('siswa'));
        }
        if (Auth::user()->level == 'admin') {
            $kelas = Kelas::all();
            return view('admin.datasiswa', compact('kelas'));
        }
    }
    public function walikelas()
    {
        return view('walikelas.dashboard');
    }
}
