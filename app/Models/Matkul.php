<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $fillable = ['kd_mk', 'nm_mk', 'slug'];
    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
