<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
   protected $table = 'movimentacoes';
   protected $primaryKey = 'id_movimentacoes';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
    'custo','quantidade','tipo_movimentacoes','id_itens_itens','id_atividades_atividades','descricao'

   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];
}
