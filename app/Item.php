<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   protected $table = 'itens';
   protected $primaryKey = 'id_itens';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'nome','custo_por_unidade','quantidade','id_unidades_unidades','id_tipos_item_tipos_item'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];
}
