<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metode extends Model
{
    use HasFactory;
    // table
    protected $table = 'metode';
    // primary key
    protected $primaryKey = 'id_metode';
    // fields
    protected $fillable = [
        'nama',
        'inisial',
        'aktif',
    ];

    // booted
    protected static function booted()
    {
        static::creating(function ($row) {
            $row->created_by = auth()->user()->id;
        });

        static::updating(function ($row) {
            $row->updated_by = auth()->user()->id;
        });
    }
}
