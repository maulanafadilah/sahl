<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'id_transaksi',
        'debit',
        'kredit',
        'keterangan',
        'id_pengguna'
    ];
}
