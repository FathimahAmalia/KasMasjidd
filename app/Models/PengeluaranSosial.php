<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranSosial extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran_sosials';

    protected $fillable = [
        'tanggal',
        'jenis_pengeluaran',
        'nominal',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}

