<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'tipe',
    ];

    public function getJenisAttribute()
    {
        return strtolower($this->attributes['tipe'] ?? $this->attributes['jenis'] ?? 'benefit');
    }

    public function getKodeAttribute()
    {
        return $this->attributes['kode_kriteria'] ?? $this->attributes['kode'] ?? '';
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'kriteria_id');
    }
}
