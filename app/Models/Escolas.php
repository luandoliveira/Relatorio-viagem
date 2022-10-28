<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escolas extends Model
{
    use HasFactory;

    protected $table = 'escolas';

    protected $fillable = [
        'cod_escola',
        'escola',
        'municipio'
    ];
}
