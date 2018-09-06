<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talhao extends Model
{
    protected $table = 'talhoes';
    protected $primaryKey = 'id_talhoes';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificador','area','descricao','tipo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];


    public function culturas()
    {
        return $this->hasMany('App\Cultura','id_talhoes_talhoes','id_talhoes');
    }


    public function requisicoes()
    {
        return $this->hasMany('App\Requisicao','id_talhoes_talhoes');
    }

    public function atividades()
    {
        return $this->hasMany('App\Atividade','id_talhoes_talhoes');
    }
}
