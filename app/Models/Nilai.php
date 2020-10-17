<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $fillable = ['id', 'siswa_id', 'kelas_id', 'semester_id', 'sakit', 'izin', 'alpa', 'spiritual', 'sosial'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function nilai_pelajaran()
    {
        return $this->hasOne(Nilai_pelajaran::class);
    }
}
