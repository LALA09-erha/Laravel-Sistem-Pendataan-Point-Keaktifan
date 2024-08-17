<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KedudukanModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'id',
        'nama_kedudukan',
    ];

    protected $primaryKey = 'id';
    // auto increment
    public $incrementing = true;
}
