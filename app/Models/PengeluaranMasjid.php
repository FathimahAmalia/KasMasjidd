<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranMasjid extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'jenis_pengeluaran',
        'nominal',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'integer',
    ];
}
