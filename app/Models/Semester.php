<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semester';
    protected $fillable = ['tahun_ajaran', 'nama_semester'];

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
