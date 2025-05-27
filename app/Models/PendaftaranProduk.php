<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranProduk extends Model
{
    use HasFactory;
    // table
    protected $table = 'pendaftaran_produk';
    // primary key
    protected $primaryKey = 'id_pendaftaran_produk';
    // fields
    protected $fillable = [
        'id_pendaftaran',
        'id_produk',
        'qty',
        'palet',
        'pcs',
        'remark',
    ];

    public function toProduk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
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
