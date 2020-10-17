<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_eskul extends Model
{
    use HasFactory;
    protected $table = 'nilai_eskul';
    protected $fillable = ['nilai_id', 'eskul_id', 'nilai_eskul', 'keterangan'];

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
    public function eskul()
    {
        return $this->belongsTo(Eskul::class);
    }
}
