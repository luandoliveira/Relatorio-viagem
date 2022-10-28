<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorios extends Model
{
    use HasFactory;
    protected $table = 'relatorios';

    protected $fillable = [
        'id_user',
        'tipo_demanda',
        'demanda',
        'objetivo',
        'relatorio',
        'observacao',
        'ida',
        'volta',
    ];
    public function relUsers(){
        return $this->hasOne('App\User', 'id','id_user');
    }
}
