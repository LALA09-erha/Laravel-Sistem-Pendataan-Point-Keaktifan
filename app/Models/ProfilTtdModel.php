<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilTtdModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nip',
        'nama',
        'jabatan',
    ];

    protected $primaryKey = 'id';
    // auto increment
    public $incrementing = true;
}
