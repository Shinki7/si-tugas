<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
public function matkul()
{
    return $this->belongsTo(Matkul::class);
}
}
