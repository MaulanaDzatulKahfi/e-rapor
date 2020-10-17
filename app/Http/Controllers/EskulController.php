<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
use Illuminate\Http\Request;

class EskulController extends Controller
{
    public function index()
    {
        $eskul = Eskul::all();
        return view('admin.dataeskul', compact('eskul'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'nama_eskul' => 'required',
        ]);

        Eskul::create($request->all());
        return redirect('/eskul')->with('sukses', 'Ekstrakulikuler berhasil ditambahkan');
    }
    public function edit($id)
    {
        $eskul = Eskul::where('id', $id)->first();
        return $eskul;
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_eskul' => 'required',
        ]);
        Eskul::where('id', $id)->update([
            'nama_eskul' => $request->nama_eskul
        ]);
        return redirect('/eskul')->with('sukses', 'Ekstrakulikuler berhasil diedit');
    }
    public function hapus(Eskul $eskul)
    {
        Eskul::destroy($eskul->id);
        return redirect('/eskul')->with('sukses', 'Ekstrakulikuler Berhasil Dihapus');
    }
}
