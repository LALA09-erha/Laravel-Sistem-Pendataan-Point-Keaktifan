<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubkategoriModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nama_subkategori',
    ];

    protected $primaryKey = 'id';
    // auto increment
    public $incrementing = true;
}
