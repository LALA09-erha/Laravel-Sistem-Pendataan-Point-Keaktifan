<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'id',
        'nama_kegiatan',
        'kategori_kegiatan',
        'kedudukan_kegiatan',
        'tingkat_kegiatan',
        'point_kegiatan',
    ];

    protected $primaryKey = 'id';
    // auto increment
    public $incrementing = true;
}
