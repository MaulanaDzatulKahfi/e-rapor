<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = DB::table('kelas')->orderBy('nama_kelas')->get();
        return view('admin.datakelas', compact('kelas'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'walikelas' => 'required',
            'nip' => 'required|numeric',
        ]);
        // $kelas = new Kelas();
        // $kelas->nama_kelas = $request->nama_kelas;
        // $kelas->walikelas = $request->walikelas;
        // $kelas->nip = $request->nip;
        // $kelas->save();
        $kelas = Kelas::create($request->all());

        $user = new User();
        $user->username = $request->nip;
        $user->password = Hash::make($request->nip);
        $user->level = 'walikelas';
        $user->nama_user = $request->walikelas;
        $user->kelas_id = $kelas->id;
        $user->save();

        return redirect('/kelas')->with('sukses', 'Kelas berhasil ditambahkan');
    }
    public function edit($id)
    {
        $kelas = Kelas::where('id', $id)->first();
        return $kelas;
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'walikelas' => 'required',
            'nip' => 'required|numeric',
        ]);
        Kelas::where('id', $id)->update([
            'nama_kelas' => $request->nama_kelas,
            'walikelas' => $request->walikelas,
        ]);
        User::where('username', $request->nip)->update([
            'nama_user' => $request->walikelas
        ]);
        return redirect('/kelas')->with('sukses', 'kelas berhasil diedit');
    }
    public function hapus(Kelas $kelas)
    {
        Kelas::destroy($kelas->id);
        User::where('username', $kelas->nip)->delete();
        return redirect('/kelas')->with('sukses', 'Kelas Berhasil Dihapus');
    }
}
