<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'content',
        'icon',
        'order',
        'is_active',
    ];
}
