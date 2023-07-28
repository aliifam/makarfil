<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}
