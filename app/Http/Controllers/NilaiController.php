<?php

namespace App\Http\Controllers;

use App\Exports\NilaiKeterampilanExport;
use App\Exports\NilaiPengetahuanExport;
use App\Exports\SikapExport;
use App\Models\Nilai;
use App\Models\Nilai_eskul;
use Illuminate\Http\Request;
use App\Exports\SiswaExport;
use App\Imports\KeterampilanImport;
use App\Imports\PengetahuanImport;
use App\Imports\SikapImport;
use App\Models\Kelas;
use App\Models\Nilai_keterampilan;
use App\Models\Nilai_pengetahuan;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::all();
        return view('nilai.dataNilai', compact('nilai'));
    }
    public function detail($id)
    {
        // $n_pelajaran = Nilai_pelajaran::where('nilai_id', $id)->get();
        // $eskul = Nilai_eskul::where('nilai_id', $id)->get();
        // $nilai = Nilai::where('id', $id)->first();
        // return view('nilai.detaiNilai', compact('n_pelajaran', 'nilai', 'eskul'));
    }
    public function pdf($id)
    {
        $n_pengetahuan = Nilai_pengetahuan::where('nilai_id', $id)->get();
        $n_keterampilan = Nilai_keterampilan::where('nilai_id', $id)->get();
        $eskul = Nilai_eskul::where('nilai_id', $id)->get();
        $nilai = Nilai::where('id', $id)->first();
        return View('nilai.pdf', compact('n_pengetahuan', 'n_keterampilan', 'nilai', 'eskul'));
        // $pdf = PDF::loadView('nilai.pdf', compact('n_pengetahuan', 'n_keterampilan', 'nilai', 'eskul'));
        // return $pdf->download($nilai->siswa->nama_siswa . '-' . $nilai->kelas->nama_kelas . '-' . $nilai->semester->tahun_ajaran . '_' . $nilai->semester->nama_semester . '.pdf');
    }
    public function export(Request $request, $id)
    {
        $kelas = Kelas::where('id', $id)->first();
        if ($request->format == 'sikap') {
            return Excel::download(new SikapExport, 'sikap-spiritual-sosial-dan-kehadiran-' . $kelas->semester->tahun_ajaran . '-' . $kelas->semester->nama_semester . '-' . $kelas->nama_kelas . '.xlsx');
        }
        if ($request->format == 'nilai_pengetahuan') {
            return Excel::download(new NilaiPengetahuanExport, 'nilai-pengetahuan-' . $kelas->semester->tahun_ajaran . '-' . $kelas->semester->nama_semester . '-' . $kelas->nama_kelas .  '.xlsx');
        }
        if ($request->format == 'nilai_keterampilan') {
            return Excel::download(new NilaiKeterampilanExport, 'nilai-keterampilan-kelas-' . $kelas->semester->tahun_ajaran . '-' . $kelas->semester->nama_semester . '-' . $kelas->nama_kelas .  '.xlsx');
        }
        if ($request->format == 'nilai_eskul') {
            return Excel::download(new SiswaExport, 'Nilai Eskul kelas ' . $kelas->nama_kelas . '.xlsx');
        }
    }
    public function importsikap(Request $request)
    {
        Excel::import(new SikapImport, $request->file('format'));

        return redirect('/nilai')->with('sukses', 'Import Sikap dan Kehadiran Berhasil');
    }
    public function importpengetahuan(Request $request)
    {
        Excel::import(new PengetahuanImport, $request->file('format'));

        return redirect('/nilai')->with('sukses', 'Import Nilai Pengetahuan Berhasil');
    }
    public function importketerampilan(Request $request)
    {
        Excel::import(new KeterampilanImport, $request->file('format'));

        return redirect('/nilai')->with('sukses', 'Import Nilai Keterampilan Berhasil');
    }
}
