<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $fillable = [
        'nip',
        'nama',
        'tgl_lahir',
        'divisi'
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_karyawan', 'id');
    }
}
