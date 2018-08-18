<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   protected $table = 'item';
   protected $primaryKey = 'id_item';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'nome','custo_por_unidade','quantidade','id_unidade_unidade','id_tipos_item_tipos_item'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];
}
