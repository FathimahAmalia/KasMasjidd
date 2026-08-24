<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'jabatan',
        'nama',
        'foto',
        'keterangan',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Parent
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo(Struktur::class, 'parent_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Children
    |--------------------------------------------------------------------------
    */

    public function children()
    {
        return $this->hasMany(Struktur::class, 'parent_id')
            ->orderBy('urutan')
            ->orderBy('id');
    }

    /*
    |--------------------------------------------------------------------------
    | Children Recursive
    |--------------------------------------------------------------------------
    */

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}