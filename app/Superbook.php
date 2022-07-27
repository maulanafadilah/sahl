<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Superbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_akun',
        'total_saldo',
        'jenis_saldo',
        'tahun',
        'id_pengguna',
    ];
}
