<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Nilai_pengetahuan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class PengetahuanImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $kelas_id = Auth::user()->kelas_id;
        $kelas = Kelas::where('id', $kelas_id)->first();
        foreach ($rows as $key => $row) {
            $id = $row[1] . $kelas_id . $kelas->semester_id;
            if ($key >= 2) {
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 1,
                    'nilai_pengetahuan' => $row[3],
                    'deskripsi_pengetahuan' => $row[4]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 2,
                    'nilai_pengetahuan' => $row[5],
                    'deskripsi_pengetahuan' => $row[6]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 3,
                    'nilai_pengetahuan' => $row[7],
                    'deskripsi_pengetahuan' => $row[8]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 4,
                    'nilai_pengetahuan' => $row[9],
                    'deskripsi_pengetahuan' => $row[10]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 5,
                    'nilai_pengetahuan' => $row[11],
                    'deskripsi_pengetahuan' => $row[12]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 6,
                    'nilai_pengetahuan' => $row[13],
                    'deskripsi_pengetahuan' => $row[14]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 7,
                    'nilai_pengetahuan' => $row[15],
                    'deskripsi_pengetahuan' => $row[16]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 8,
                    'nilai_pengetahuan' => $row[17],
                    'deskripsi_pengetahuan' => $row[18]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 9,
                    'nilai_pengetahuan' => $row[19],
                    'deskripsi_pengetahuan' => $row[20]
                ]);
                Nilai_pengetahuan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 10,
                    'nilai_pengetahuan' => $row[21],
                    'deskripsi_pengetahuan' => $row[22]
                ]);
            }
        }
    }
}
