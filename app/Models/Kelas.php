<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['kelas', 'matkul_id','mahasiswa_id', 'dosen_id', 'jurusan', 'angkatan', 'semester'];
    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function mahasiswa(){
        return $this->belongsToMany(Mahasiswa::class, 'kelas_mahasiswa');
    }

}

