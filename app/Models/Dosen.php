<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    protected $table = 'dosen';

    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'password',
    ];

    public function kelas(){
        $this->hasMany(Kelas::class);
    }
}
