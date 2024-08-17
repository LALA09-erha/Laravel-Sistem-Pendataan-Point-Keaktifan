<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeaktifanMahasiswaModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'id',
        'nama_mahasiswa',
        'nim',
        'semester',
        'data_kegiatan',
        'file_kegiatan',
        'point_kegiatan',
        'status',
    ];

    protected $primaryKey = 'id';
    // auto increment
    public $incrementing = true;
}
