<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'jumlah',
        'jenis_donasi',
        'pesan',
        'status',
        'payment_method',
        'transaction_id',
        'tanggal_donasi'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal_donasi' => 'datetime',
    ];
}
