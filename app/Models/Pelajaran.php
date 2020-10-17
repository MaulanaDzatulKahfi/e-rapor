<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory;
    protected $table = 'pelajaran';
    protected $fillable = ['nama_pelajaran', 'kelompok'];

    public function nilai_pelajaran()
    {
        return $this->hasOne(Nilai_pelajaran::class);
    }
}
