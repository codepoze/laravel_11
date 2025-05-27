<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    // table
    protected $table = 'produk';
    // primary key
    protected $primaryKey = 'id_produk';
    // fields
    protected $fillable = [
        'id_satuan',
        'nama',
        'tipe',
        'deskripsi',
    ];

    public function toSatuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }

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
