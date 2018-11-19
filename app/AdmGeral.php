<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmGeral extends Model
{
   protected $table = 'adms_geral';
   protected $primaryKey = 'id_adms_geral';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "data_inicio","data_fim","id_funcionarios_funcionarios"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];

    public function culturas()
    {
        return $this->hasMany('App\Atividade','id_adms_gerais_adms_gerais');
    }

    public function atividades()
    {
        return $this->hasMany('App\Atividade','id_adms_gerais_adms_gerais');
    }

    public function funcionarios(){
        return $this->belongsTo('App\AdmTalhao');
    }
}
