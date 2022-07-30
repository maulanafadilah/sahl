<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perubahan_modal extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_saldo',
        'tahun',
        'id_pengguna',
    ];
}
