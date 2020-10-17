<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Siswa::where('kelas_id', Auth::user()->kelas_id)->get();
    }
    public function map($siswa): array
    {
        return [
            $siswa->nis,
            $siswa->nama_siswa,
        ];
    }
}
