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
      'nome','custo_por_unidade','quantidade','id_unidades_unidades','id_tipos_itens_tipos_itens'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];

  public function unidade()
  {
        return $this->belongsTo('App\Unidade','id_unidades_unidades');
  }

  public function tipo_item()
  {
        return $this->belongsTo('App\TipoItem','id_tipos_itens_tipos_itens');
  }
}
