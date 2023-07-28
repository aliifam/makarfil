<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode'
    ];

    public function provinsis()
    {
        return $this->hasMany(Provinsi::class);
    }
}
