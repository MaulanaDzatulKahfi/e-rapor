<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Nilai_keterampilan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class KeterampilanImport implements ToCollection
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
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 1,
                    'nilai_keterampilan' => $row[3],
                    'deskripsi_keterampilan' => $row[4]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 2,
                    'nilai_keterampilan' => $row[5],
                    'deskripsi_keterampilan' => $row[6]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 3,
                    'nilai_keterampilan' => $row[7],
                    'deskripsi_keterampilan' => $row[8]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 4,
                    'nilai_keterampilan' => $row[9],
                    'deskripsi_keterampilan' => $row[10]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 5,
                    'nilai_keterampilan' => $row[11],
                    'deskripsi_keterampilan' => $row[12]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 6,
                    'nilai_keterampilan' => $row[13],
                    'deskripsi_keterampilan' => $row[14]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 7,
                    'nilai_keterampilan' => $row[15],
                    'deskripsi_keterampilan' => $row[16]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 8,
                    'nilai_keterampilan' => $row[17],
                    'deskripsi_keterampilan' => $row[18]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 9,
                    'nilai_keterampilan' => $row[19],
                    'deskripsi_keterampilan' => $row[20]
                ]);
                Nilai_keterampilan::create([
                    'nilai_id' => $id,
                    'pelajaran_id' => 10,
                    'nilai_keterampilan' => $row[21],
                    'deskripsi_keterampilan' => $row[22]
                ]);
            }
        }
    }
}
