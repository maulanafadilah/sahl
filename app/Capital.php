<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_modal',
        'nominal',
        'id_pengguna',
        'keterangan'
    ];
}
