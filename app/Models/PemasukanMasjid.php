<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanMasjid extends Model
{
    use HasFactory;

   
    protected $table = 'pemasukan_masjids';

    protected $fillable = [
        'tanggal',
        'sumber_dana',
        'keterangan',
        'nominal',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'integer',
    ];
}
