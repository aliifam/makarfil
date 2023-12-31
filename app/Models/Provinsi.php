<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'negara_id'
    ];

    public function kotas()
    {
        return $this->hasMany(Kota::class);
    }

    public function negara()
    {
        return $this->belongsTo(Negara::class);
    }
}
