<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanSosial extends Model
{
      use HasFactory;

    protected $table = 'pemasukan_sosials'; 

    protected $fillable = [
        'tanggal',
        'sumber_dana',
        'jumlah',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

}
