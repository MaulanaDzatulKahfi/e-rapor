<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NilaiPengetahuanExport implements FromView
{
    public function view(): View
    {
        return view('nilai.format.nilaiPengetahuan', [
            'siswa' => Siswa::where('kelas_id', Auth::user()->kelas_id)->get(),
        ]);
    }
}
