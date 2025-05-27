<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
{
    use HasFactory;
    // table
    protected $table = 'antrean';
    // primary key
    protected $primaryKey = 'id_antrean';
    // fields
    protected $fillable = [
        'id_pendaftaran',
        'no_antrean',
        'status',
    ];

    public function toPendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_pendaftaran');
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
