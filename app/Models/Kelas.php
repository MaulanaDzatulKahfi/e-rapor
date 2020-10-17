<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'walikelas', 'nip', 'semester_id'];

    public function siswa()
    {
        return $this->hasMany('App\Models\Siswa');
    }
    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
    function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
