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
       'data','descricao','descricao_adms_gerais', 'id_adms_talhoes_adms_talhoes', 'id_requisicoes_status_requisicoes'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];
}
