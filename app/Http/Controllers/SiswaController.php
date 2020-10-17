<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('siswa.index', compact('kelas'));
    }
    public function cari($id)
    {
        $siswa = DB::table('kelas')
            ->leftjoin('siswa', 'kelas.id', '=', 'siswa.kelas_id')
            ->where('siswa.kelas_id', '=', $id)
            ->orderBy('nama_siswa', 'ASC')
            ->get();
        return $siswa;
    }
    public function dashboard()
    {
        return view('siswa.dashboard');
    }
    public function tambah_siswa(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'kelas_id' => 'required',
            'nis' => 'required|numeric',
        ]);
        $user = new User();
        $user->username = $request->nis;
        $user->password = Hash::make($request->nis);
        $user->level = 'siswa';
        $user->nama_user = $request->nama_siswa;
        $user->kelas_id = $request->kelas_id;
        $user->save();

        $request->request->add(['user_id' => $user->id]);
        Siswa::create($request->all());
        return redirect('/datasiswa')->with('sukses', 'Siswa berhasil ditambahkan');
    }
    public function edit($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        return $siswa;
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nisuser' => 'required|numeric',
            'kelas' => 'required'
        ]);
        Siswa::where('id', $id)->update([
            'nama_siswa' => $request->nama,
            'kelas_id' => $request->kelas,
        ]);
        User::where('username', $request->nip)->update([
            'nama_user' => $request->nama,
            'kelas_id' => $request->kelas,
        ]);
        return redirect('/datasiswa')->with('sukses', 'Siswa berhasil diedit');
    }
    public function hapus(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);
        User::where('username', $siswa->nis)->delete();
        return redirect('/datasiswa')->with('sukses', 'Siswa Berhasil Dihapus');
    }
}
