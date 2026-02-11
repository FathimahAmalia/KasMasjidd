<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
        protected $fillable = ['title', 'image', 'category', 'description', 'is_active'];
}
