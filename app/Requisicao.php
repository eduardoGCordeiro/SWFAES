<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisicao extends Model
{
   protected $table = 'requisicoes';
   protected $primaryKey = 'id_requisicoes';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [

       'data','descricao','descricao_adms_gerais', 'id_adms_talhoes_adms_talhoes','id_talhoes_talhoes'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];


    public function talhoes(){
        return $this->belongsTo('App\Talhao');
    }
    public function talhao(){
        return $this->hasOne('App\Talhao','id_talhoes','id_talhoes_talhoes');
    }

    public function moderar_requisicao(){
        return $this->hasMany('App\ModerarRequisicoes','id_requisicoes_requisicoes','id_requisicoes');
    }
}
