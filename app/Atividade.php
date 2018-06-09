<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
   protected $table = 'atividades';
   protected $primaryKey = 'id_atividades';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
        
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];

  public function movimentacao()
  {
    return $this->hasMany('App\Movimentacao','id_atividades_atividades');
  }
}
