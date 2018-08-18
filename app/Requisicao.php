<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisicao extends Model
{
   protected $table = 'requisicao';
   protected $primaryKey = 'id_requisicoes';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'data_inicio','descricao','data_fim', 'tipos_safra', 'id_talhoes_talhoes'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];
}
