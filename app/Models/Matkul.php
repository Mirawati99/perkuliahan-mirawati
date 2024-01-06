<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->hasMany(mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasMany(dosen::class);
    }
}
