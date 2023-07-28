<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nama_lengkap',
        'email',
        'alamat',
        'tanggal_bergabung',
        'kota_id',
        'departemen_id',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function negara()
    {
        return $this->belongsTo(Negara::class);
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

}
