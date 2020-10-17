<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = ['nama_siswa', 'nis', 'kelas_id', 'user_id'];
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas');
    }
    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
}
