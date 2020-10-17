<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    public function index()
    {
        $pelajaran = Pelajaran::all();
        return view('admin.datapelajaran', compact('pelajaran'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'nama_pelajaran' => 'required',
            'kelompok' => 'required',
        ]);

        Pelajaran::create($request->all());
        return redirect('/pelajaran')->with('sukses', 'mata pelajaran berhasil ditambahkan');
    }
    public function edit($id)
    {
        $kelas = Pelajaran::where('id', $id)->first();
        return $kelas;
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelajaran' => 'required',
            'kelompok' => 'required',
        ]);
        Pelajaran::where('id', $id)->update([
            'nama_pelajaran' => $request->nama_pelajaran,
            'kelompok' => $request->kelompok
        ]);
        return redirect('/pelajaran')->with('sukses', 'Mata Pelajaran berhasil diedit');
    }
    public function hapus(Pelajaran $pelajaran)
    {
        Pelajaran::destroy($pelajaran->id);
        return redirect('/pelajaran')->with('sukses', 'Mata Pelajaran Berhasil Dihapus');
    }
}
