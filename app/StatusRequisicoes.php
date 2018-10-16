<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusRequisicoes extends Model
{
    protected $table = 'status_requisicoes';
   protected $primaryKey = 'id_status_requisicoes';
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

    public function moderarequisicoes(){
        return $this->hasmay('App\ModerarRequisicoes', 'id_requisicoes_status_requisicoes', 'id_status_requisicoes');
    }
}
