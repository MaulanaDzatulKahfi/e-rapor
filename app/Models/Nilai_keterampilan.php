<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_keterampilan extends Model
{
    use HasFactory;
    protected $table = 'nilai_keterampilan';
    protected $fillable = ['nilai_id', 'pelajaran_id', 'nilai_keterampilan', 'deskripsi_keterampilan'];
}
