<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_pengetahuan extends Model
{
    use HasFactory;
    protected $table = 'nilai_pengetahuan';
    protected $fillable = ['nilai_id', 'pelajaran_id', 'nilai_pengetahuan', 'deskripsi_pengetahuan'];

    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
}
