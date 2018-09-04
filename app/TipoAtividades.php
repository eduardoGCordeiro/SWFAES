<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAtividades extends Model
{
    protected $table = 'tipos_atividades';
   protected $primaryKey = 'id_tipos_atividades';
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
   protected $hidden = [ ];

    public function atividade(){
        return $this->belongsTo('App\Atividade');
    }
}
