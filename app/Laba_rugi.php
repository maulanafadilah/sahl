<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laba_rugi extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_saldo',
        'tahun',
        'id_pengguna',
    ];
}
