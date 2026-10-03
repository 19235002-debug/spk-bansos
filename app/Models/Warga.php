<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'alternatif';

    protected $fillable = [
        'user_id',
        'no_kk',
        'nik',
        'nama_warga',
        'rt_rw',
        'alamat',
        'pekerjaan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'alternatif_id');
    }

    /**
     * Backward compatibility accessors for nim, nama_mahasiswa, prodi
     */
    public function getNimAttribute()
    {
        return $this->attributes['nik'] ?? null;
    }

    public function getNamaMahasiswaAttribute()
    {
        return $this->attributes['nama_warga'] ?? null;
    }

    public function getProdiAttribute()
    {
        return $this->attributes['rt_rw'] ?? null;
    }
}
