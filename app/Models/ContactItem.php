<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'icon',
        'url',
        'is_active',
        'order',
    ];
}
