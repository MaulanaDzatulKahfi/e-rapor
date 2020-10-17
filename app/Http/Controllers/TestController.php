<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Nilai_eskul;
use App\Models\Nilai_pelajaran;
use App\Models\Semester;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use PDF;

class testController extends Controller
{
    public function index()
    {
        $test = [];
        $pelajaran = DB::table('pelajaran')->get();
        $eskul = DB::table('eskul')->get();
        $data_nilai = [
            'id' => 2,
            'siswa_id' => 12,
            'kelas_id' => 2,
            'semester_id' => 2,
            'deskripsi' => 'aw',
            'sakit' => '10',
            'izin' => '6',
            'alpa' => '20'
        ];
        $nilai_pelajaran = [];
        foreach ($pelajaran as $p) {
            $nilai_pelajaran[] = [
                'nilai_id' => 2,
                'pelajaran_id' => $p->id,
                'nilai_pengetahuan' => 95,
                'nilai_keterampilan' => 90,
                'desk_pengetahuan' => 'bagus',
                'desk_keterampilan' => 'bagus',
                'desk_spiritual' => 'bagus',
            ];
        }
        $nilai_eskul = [];
        foreach ($eskul as $s) {
            $nilai_eskul[] = [
                'nilai_id' => 2,
                'eskul_id' => $s->id,
                'nilai_eskul' => 88,
                'keterangan' => 'baik'
            ];
        }
        // DB::table('nilai')->insert($data_nilai);
        // DB::table('nilai_pelajaran')->insert($nilai_pelajaran);
        // DB::table('nilai_eskul')->insert($nilai_eskul);
        return redirect('/nilai');
    }
    public function view()
    {
        $nilai_pelajaran = DB::table('nilai_pelajaran')
            ->leftjoin('nilai', 'nilai.id', '=', 'nilai_pelajaran.nilai_id')
            ->leftjoin('pelajaran', 'pelajaran.id', '=', 'nilai_pelajaran.pelajaran_id')
            // ->where('nilai_pelajaran.sisw', '=', 1)
            ->get();
        dump($nilai_pelajaran);
    }
    public function pdf($id)
    {
        // $n_pelajaran = Nilai_pelajaran::where('nilai_id', $id)->get();
        $eskul = Nilai_eskul::where('nilai_id', $id)->get();
        $nilai = Nilai::where('id', $id)->first();
        return view('nilai.pdf', compact('n_pelajaran', 'nilai', 'eskul'));
    }
    public function setcookie(Request $request)
    {
        $tahunajaran = cookie('tahun_ajaran', '2020-2021', 60);
        $semester = cookie('semester', 'ganjil', 60);
        return response('Hello World')->cookie($tahunajaran, $semester);
    }
    public function getCookie(Request $request)
    {
        $value = $request->cookie('semester');
        // $value = $request->cookie('tahun_ajaran');
        echo $value;
    }
}
