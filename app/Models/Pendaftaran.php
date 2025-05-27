<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    // table
    protected $table = 'pendaftaran';
    // primary key
    protected $primaryKey = 'id_pendaftaran';
    // fields
    protected $fillable = [
        'id_kendaraan',
        'id_metode',
        'no_so',
        'distributor',
        'nama',
        'tujuan',
        'no_hp',
        'no_identitas',
        'approved',
    ];

    public function toKendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id_kendaraan');
    }

    public function toMetode()
    {
        return $this->belongsTo(Metode::class, 'id_metode', 'id_metode');
    }

    public function toAntrean()
    {
        return $this->belongsTo(Antrean::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    public function toPendaftaranProduk()
    {
        return $this->hasMany(PendaftaranProduk::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
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
