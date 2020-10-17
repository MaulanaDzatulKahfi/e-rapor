<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class SikapImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $kelas_id = Auth::user()->kelas_id;
        $kelas = Kelas::where('id', $kelas_id)->first();
        foreach ($rows as $key => $row) {
            $siswa = Siswa::where('nis', $row[1])->first();
            $id = $row[1] . $kelas_id . $kelas->semester_id;
            if ($key >= 2) {
                Nilai::create([
                    'id' => $id,
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $kelas_id,
                    'semester_id' => $kelas->semester_id,
                    'spiritual' => $row[3],
                    'sosial' => $row[4],
                    'sakit' => $row[5],
                    'izin' => $row[6],
                    'alpa' => $row[7],
                ]);
            }
        }
    }
}
