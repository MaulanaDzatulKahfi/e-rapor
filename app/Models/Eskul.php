<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eskul extends Model
{
    use HasFactory;
    protected $table = 'eskul';
    protected $fillable = ['nama_eskul'];

    public function nilai_eskul()
    {
        return $this->hasOne(Nilai_eskul::class);
    }
}
