<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoItem extends Model
{
    protected $table = 'tipos_itens';
    protected $primaryKey = 'id_tipos_itens';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
}
